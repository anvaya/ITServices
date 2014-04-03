<?php

require_once dirname(__FILE__).'/../lib/memberGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/memberGeneratorHelper.class.php';

/**
 * member actions.
 *
 * @package    BestBuddies
 * @subpackage member
 * @author     Anvaya Technologies
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class memberActions extends autoMemberActions
{
  public function executeShow(sfWebRequest $request)
  {
    $this->member = $this->getRoute()->getObject();
  }
  
  public function executeAjaxAutoComplete(sfWebRequest $request)
  {       
        $match = $request->getParameter('term', "");
        $limit = $request->getParameter('limit', 20);

        
        $list = memberTable::getInstance()->getListForAjax($match, $limit);
        
        $this->renderText(json_encode($list));
        return sfView::NONE;
  }
  
  public function executeActivateMember(sfWebRequest $request)
  {
      $this->form = new activateMemberForm();
  }
  
  public function executeActivate(sfWebRequest $request)
  {
      $member = $this->getRoute()->getObject();
      
      $sid = $request->getParameter('sid', false);
      
      $subscription = member_subscriptionTable::getInstance() 
                        ->createQuery('ms')
                        ->addWhere('ms.member_id = ?', $member->getId())              
                        ->orderBy('ms.id desc')
                        ->fetchOne();
      $result = 0;
      
      if($subscription)
      {
                    
          $member->setIsActive(1);
          $member->save();
          
          /* @var $subscription member_subscription */
          if($sid)
          {
              $subscription->setSubscriptionId($sid);              
          }
          $subscription->setActive(1);
          $subscription->save();
          
          $this->getUser()->setFlash('notice','The account has been activated');
          $email_body = $this->getPartial("email_activation", array("user"=>$member, "subscription"=>$subscription));
          
          try
          {
            $mailer =  $this->getMailer();
            
            $msg = $mailer->compose();
            $msg->setSubject("You Groworth.in account is now active");
            $msg->addFrom("nriservices@groworth.in","Groworth Real Solutions Pvt. Ltd");
            $msg->addReplyTo("nrihelp@groworth.in", "Groworth Real Solutions Pvt. Ltd");
            $msg->addTo($member->getEmailAddress() , $member->getFirstName() );            
            $msg->setBody($email_body, 'text/html', "utf-8");
            $this->getMailer()->sendNextImmediately();
            $mailer->send($msg);
              
            $msg = $mailer->compose();
            $msg->setSubject("You Groworth.in account is now active");
            $msg->addFrom("nriservices@groworth.in","Groworth Real Solutions Pvt. Ltd");
            $msg->addReplyTo("nrihelp@groworth.in", "Groworth Real Solutions Pvt. Ltd");
            //$msg->addTo("sandeep.groworth@gmail.com","Sandeep Ghadge");    
            $msg->addTo("mrugendrabhure@gmail.com","Mrugendra Bhure" );            
            $msg->setBody($email_body, 'text/html', "utf-8");
            $this->getMailer()->sendNextImmediately();
            $mailer ->send($msg);
            
            $coupon = member_couponTable::getInstance()
                        ->createQuery('mc')
                        ->innerJoin('mc.coupon c')
                        ->addWhere('mc.member_id = ?', $member->getId())
                        ->addWhere('mc.used is null or mc.used = 0')                        
                        ->addWhere('c.coupon_type = ?', couponTable::COUPON_TYPE_SPOUCE_DISCOUNT )
                        ->orderBy('mc.id desc')
                        ->fetchOne();
            
            if($coupon)
            {                
                /* @var $coupon member_coupon */
                
                $coupon_code = $coupon->getCouponCode();
                $valid_till  = format_date($subscription->getSubscription()->getEndDate(),"dd/MM/y");
                $email_body = $this->getPartial("email_coupon", array("user"=>$member, "subscription"=>$subscription,"valid_till"=>$valid_till, "coupon_code"=>$coupon_code));
                $spouce = $member->getGender()=="M"?"wife":"husband";
                        
                $msg = $mailer->compose();
                $msg->setSubject("Important news for your ".$spouce);
                $msg->addFrom("nriservices@groworth.in","Groworth Real Solutions Pvt. Ltd");
                $msg->addReplyTo("nrihelp@groworth.in", "Groworth Real Solutions Pvt. Ltd");
                $msg->addTo("sandeep.groworth@gmail.com","Sandeep Ghadge");    
                $msg->addTo("mrugendrabhure@gmail.com","Mrugendra Bhure" );            
                $msg->addTo("mrugendra999@yahoo.com","Mrugendra Bhure" );            
                $msg->setBody($email_body, 'text/html', "utf-8");
                $this->getMailer()->sendNextImmediately();
                $mailer ->send($msg);
            }
          }catch (Exception $ex) 
          {

          }
          
          $this->sendOrderPayAlert($member, $subscription);
          $result = 1;
      }
      
      if($request->isXmlHttpRequest())
      {
          $this->renderText("".$result);
          return sfView::NONE;
      }
      
      $this->redirect(array('sf_route' => 'member_edit', 'sf_subject' => $member));
  }
  
  public function executeOrderEmail(sfWebRequest $request)
  {
      $member = $this->getRoute()->getObject();
      
      $subscription = member_subscriptionTable::getInstance() 
                        ->createQuery('ms')
                        ->addWhere('ms.member_id = ?', $member->getId())
                        ->orderBy('ms.id desc')
                        ->fetchOne();
      
      $sent = $this->sendOrderPayAlert($member, $subscription);
	  $this->renderText('Sent '.$sent.' emails.');
      return sfView::NONE;
  }
  
  /**
   * Sends Order Payment Received Email Alert
   * @param member $member
   * @param member_subscription $subscription
   */
  private function sendOrderPayAlert($member, $subscription)
  {
      try
        {
            /* @var $subscription member_subscription */
          $sub_id = $subscription->getSubscriptionId();

          $products = productTable::getInstance()                 
                              ->createQuery('pr')
                              ->select('pr.name as product_name')                              
                              ->innerJoin('pr.subscription_product sp')                              
                              ->addWhere('sp.subscription_id = ?', $sub_id)
                              ->fetchArray();                   
          
          $order_no = $subscription->getSubscriptionId().$subscription->getId().$member->getId();
          
          $amount = $subscription->getPrice();
          $email_body =  $this->getPartial("email_order_complete_customer", array("user"=>$member,"order_no"=>$order_no,"products"=>$products,"amount"=>$amount));

          $msg = $this->getMailer()->compose();
          $msg->setSubject("Payment Received for Order #".$order_no);
          $msg->addFrom("nriservices@groworth.in","Groworth Real Solutions Pvt. Ltd");
          $msg->addReplyTo("nrihelp@groworth.in", "Groworth Real Solutions Pvt. Ltd");
          $msg->addTo($member->getEmailAddress() , $member->getFirstName() );            
          $msg->setBody($email_body, 'text/html', "utf-8");
          $this->getMailer()->sendNextImmediately();
          $this->getMailer()->send($msg);

          $msg = $this->getMailer()->compose();
          $msg->setSubject("Payment Received for Order #".$order_no);
          $msg->addFrom("nriservices@groworth.in","Groworth Real Solutions Pvt. Ltd");
          $msg->addReplyTo("nrihelp@groworth.in", "Groworth Real Solutions Pvt. Ltd");
          $msg->addTo("sandeep.groworth@gmail.com","Sandeep Ghadge");    
          $msg->addTo("mrugendrabhure@gmail.com","Mrugendra Bhure" );            
          $msg->setBody($email_body, 'text/html', "utf-8");

          $this->getMailer()->sendNextImmediately();
          return $this->getMailer()->send($msg);

        } catch (Exception $ex) 
        {
           $this->renderText($ex->getMessage());     
        }       
		return 0;
  }
  
  
}
