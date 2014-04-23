<?php

/**
 * subscription actions.
 *
 * @package    BestBuddies
 * @subpackage subscription
 * @author     Anvaya Technologies
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class subscriptionActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->forward('default', 'module');
  }
  
  public function executeRenew(sfWebRequest $request)
  {
      $member_id = $this->getUser()->getGuardUser()->getId();
      $member    = memberTable::getInstance()
                        ->find($member_id);
      if(!$member)
      {
          $this->forward404 ();
      }
      
      /* @var $member member */
      $subscription = $member->getCurrentActiveSubscription();
      
      /*if( ($old_coupon = $subscription->getMemberCoupon()) )
      {
          //Spouce discount applies.
          $this->discount_amount = $old_coupon->getCoupon()->getDiscountRate();
      }
      else
      {
          $this->discount_amount = 0;
      }*/
      
      $this->discount_amount = 0;
      
      /* @var $subscription member_subscription */
      $current_subscription = subscriptionTable::getInstance()->getCurrentSubscription();
      
      if($subscription->getId() == $current_subscription->getId() )
      {
          $this->forward404 ();
      }
      
      $this->currentSubscription = $current_subscription;      
  }
  
  public function executeCheckCoupon(sfWebRequest $request)
  {
      $amount = 0;
      $cc = $request->getParameter('cc');
      
      if($cc)
      {
          $member_coupon = member_couponTable::getInstance()
                            ->createQuery('mc')
                            ->innerJoin('mc.coupon c')
                            ->addWhere('mc.coupon_code = ?', $cc)
                            ->addWhere('c.coupon_type = ?', couponTable::COUPON_TYPE_SPOUCE_DISCOUNT)
                            ->addWhere('mc.member_id <> ?', $this->getUser()->getGuardUser()->getId())
                            ->addWhere('mc.used is null or mc.used = 0')
                            ->fetchOne();    
          
          /* @var $member_coupon member_coupon */
          if($member_coupon)
          {              
            $amount = $member_coupon->getCoupon()->getDiscountRate();
          }
      }
      
      $this->renderText(json_encode(array("amount"=>$amount)));
      return sfView::NONE;
  }
  
  public function executeRenewConfirm(sfWebRequest $request)
  {
      $member_id = $this->getUser()->getGuardUser()->getId();
      $member    = memberTable::getInstance()
                        ->find($member_id);
      if(!$member)
      {
          $this->forward404 ();
      }
      
      /* @var $member member */
      $subscription = $member->getCurrentActiveSubscription();
      
      /* @var $subscription member_subscription */
      $current_subscription = subscriptionTable::getInstance()->getCurrentSubscription();
      
      if($subscription->getSubscriptionId() == $current_subscription->getId() )
      {
          $this->result = "ALREADY_RENEWED";
          return sfView::SUCCESS;
      }      
      
      //Check if already requested for renewal
      $already_requested = member_subscriptionTable::getInstance()
                ->createQuery('ms')
                ->addWhere('ms.member_id = ?', $member_id)
                ->addWhere('ms.subscription_id = ?', $current_subscription->getId())
                ->count();
      
      if($already_requested > 0)
      {
          $this->result = "ALREADY_REQUESTED";
          return sfView::SUCCESS;
      }
      
      $ms = new member_subscription();
      $ms->setMember($member);
      $ms->setSubscription($current_subscription);
      $ms->setItrProductId($current_subscription->getITRProductId());
      $ms->setStartDate(date('Y-m-d'));
      $ms->setPrice($current_subscription->getPrice());
      
      if($request->hasParameter('cc') && ($cc = $request->getParameter('cc')) )
      {          
          $member_coupon = member_couponTable::getInstance()
                            ->createQuery('mc')
                            ->innerJoin('mc.coupon c')
                            ->addWhere('mc.coupon_code = ?', $cc)
                            ->addWhere('c.coupon_type = ?', couponTable::COUPON_TYPE_SPOUCE_DISCOUNT)
                            ->addWhere('mc.member_id <> ?', $this->getUser()->getGuardUser()->getId())
                            ->addWhere('mc.used is null or mc.used = 0')
                            ->fetchOne();                            
          
          /* @var $member_coupon member_coupon */
          if($member_coupon)
          {
              $ms->setMemberCouponId($member_coupon->getId());
          }
          else
          {
              $this->getUser()->setFlash('error','Your renewal could not be ordered. Invalid Coupon Code', 'admin_module');
              $this->redirect('subscription/renew');
          }
      }      
      
      $ms->save();
      
      $this->sendPaymentEmail($member, $ms);
      $this->sendAdminAlert($member);
      $this->result = "SAVED";      
  }
  
  private function sendPaymentEmail(member $user, member_subscription $subscription)
  {
        try
        {
            /* @var $subscription member_subscription */
            $amount = $subscription->getPrice();
            
            $m_coupon = $subscription->getMemberCoupon();
            if($m_coupon)
            {
                $coupon = $m_coupon->getCoupon();
                if( ($discount = $coupon->getDiscountRate()) )
                {
                    $amount -= $discount;
                }
            }
            
            $amount = $subscription->getSubscription()->getCurrency()." ".$amount;
            
            $body = $this->getPartial("email_payment", array("user"=>$user,'amount'=>$amount, "subscription"=>$subscription));
            
            //file_put_contents(sfConfig::get('sf_log_dir')."/email_payment.html", $body);
            
            $msg = $this->getMailer()->compose();
            $msg->setSubject("Please complete your renewal");
            $msg->addFrom("nriservices@groworth.in","Groworth Real Solutions Pvt. Ltd");
            $msg->addReplyTo("nrihelp@groworth.in", "Groworth Real Solutions Pvt. Ltd");
            $msg->addTo($user->getEmailAddress() , $user->getFirstName() );            
            $msg->setBody($body, 'text/html', "utf-8");
            $this->getMailer()->sendNextImmediately();
            $this->getMailer()->send($msg);
            
            $msg = $this->getMailer()->compose();
            $msg->setSubject("Please complete your renewal");
            $msg->addFrom("nriservices@groworth.in","Groworth Real Solutions Pvt. Ltd");
            $msg->addReplyTo("nrihelp@groworth.in", "Groworth Real Solutions Pvt. Ltd");
            $msg->addTo("sandeep.groworth@gmail.com","Sandeep Ghadge");            
            $msg->addCc("mrugendrabhure@gmail.com","Mrugendra Bhure");            
            $msg->setBody($body, 'text/html', "utf-8");
            $this->getMailer()->sendNextImmediately();
            $this->getMailer()->send($msg);
            
        }catch (Exception $ex) 
        {
            try
            {
                file_put_contents(sfConfig::get('sf_log_dir')."/email_welcome.log", $ex->getMessage());
            }catch(Exception $ex) {}
            //$message = $ex->getMessage();
        }
    }
    
    private function sendAdminAlert($user)
    {
        try
        {
            $body = $this->getPartial("email_register_alert", array("user"=>$user));
            
            $msg = $this->getMailer()->compose();
            $msg->setSubject("Groworth.in: User requested a renewal");
            $msg->addFrom("nriservices@groworth.in","Groworth Real Solutions Pvt. Ltd");
            $msg->addReplyTo("nrihelp@groworth.in", "Groworth Real Solutions Pvt. Ltd");
            $msg->addTo("sandeep.groworth@gmail.com","Sandeep Ghadge");
            $msg->addCc("nrihelp@groworth.in","Groworth Real Solutions Pvt. Ltd");
            $msg->addCc("mrugendrabhure@gmail.com", "Mrugendra Bhure");
            $msg->setBody($body, 'text/plain', "utf-8");
            $this->getMailer()->sendNextImmediately();
            $this->getMailer()->send($msg);
            
        }catch (Exception $ex) 
        {
            $message = $ex->getMessage();
        }
    }
  
}
