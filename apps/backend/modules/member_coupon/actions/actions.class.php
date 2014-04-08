<?php

require_once dirname(__FILE__).'/../lib/member_couponGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/member_couponGeneratorHelper.class.php';

/**
 * member_coupon actions.
 *
 * @package    BestBuddies
 * @subpackage member_coupon
 * @author     Anvaya Technologies
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class member_couponActions extends autoMember_couponActions
{
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $is_new = $form->getObject()->isNew();
      $notice = $is_new ? 'The item was created successfully.' : 'The item was updated successfully.';           
      
      $member_coupon = $form->save();

      if($is_new)
      {
          $this->sendMemberEmail($member_coupon);
      }
      
      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $member_coupon)));

      if ($request->hasParameter('_save_and_add'))
      {
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');

        $this->redirect('@member_coupon_new');
      }
      else
      {
        $this->getUser()->setFlash('notice', $notice);

        $this->redirect(array('sf_route' => 'member_coupon_edit', 'sf_subject' => $member_coupon));
      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
  
  private function sendMemberEmail(member_coupon $coupon)
  {
      $sent = 0;
      try
      {            
            $coupon_code    = $coupon->getCouponCode();
            $member         = $coupon->getMember();
            
            if($coupon->getCoupon()->getCouponType()==couponTable::COUPON_TYPE_SPOUCE_DISCOUNT)
            {
                $subscription   = $member->getCurrentActiveSubscription();
                $valid_till  = format_date($subscription->getSubscription()->getEndDate(),"dd/MM/y");
                $email_body = $this->getPartial("member/email_coupon", array("user"=>$member, "subscription"=>$subscription,"valid_till"=>$valid_till, "coupon_code"=>$coupon_code));
                $spouce = $member->getGender()=="M"?"wife":"husband";
                $subject = "Important news for your ".$spouce;
            }
            else //Other coupon type
            {
                
            }
            
            $mailer  = $this->getMailer();
            $msg = $mailer->compose();
            $msg->setSubject($subject);
            $msg->addFrom("nriservices@groworth.in","Groworth Real Solutions Pvt. Ltd");
            $msg->addReplyTo("nrihelp@groworth.in", "Groworth Real Solutions Pvt. Ltd");
            $msg->addTo($member->getEmailAddress() , $member->getFirstName() );
            $msg->setBody($email_body, 'text/html', "utf-8");
            $mailer->sendNextImmediately();
            $sent = $mailer ->send($msg);

            $msg = $mailer->compose();
            $msg->addFrom("nriservices@groworth.in","Groworth Real Solutions Pvt. Ltd");
            $msg->setSubject($subject);
            $msg->addTo("sandeep.groworth@gmail.com","Sandeep Ghadge");    
            $msg->addCc("mrugendrabhure@gmail.com","Mrugendra Bhure" );
            $msg->addReplyTo("nrihelp@groworth.in", "Groworth Real Solutions Pvt. Ltd");
            $msg->setBody($email_body, 'text/html', "utf-8");
            $mailer->sendNextImmediately();
            $mailer ->send($msg);
            
      } catch (Exception $ex) 
      {
          $sent = -1;  
      }
      return $sent;
  }
  
}
