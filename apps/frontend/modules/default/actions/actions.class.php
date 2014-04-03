<?php

/**
 * default actions.
 *
 * @package    BestBuddies
 * @subpackage default
 * @author     Anvaya Technologies
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class defaultActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    //$this->page = site_pageTable::getInstance()->findOneByTitle('Home');
  }
  
  public function executeContact(sfWebRequest $request)
  {
      $form = new contactusForm();
      
      if($request->getMethod()==sfWebRequest::POST)
      {
          $captcha = array(
            'recaptcha_challenge_field' => $request->getParameter('recaptcha_challenge_field'),
            'recaptcha_response_field'  => $request->getParameter('recaptcha_response_field'),);
            
          
          $form->bind(array_merge($request->getParameter($form->getName()), array('captcha' => $captcha)));
      
          //$form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
          
          if($form->isValid())
          {
              $member_id = $form->getValue("member_id");
              
              if(!$member_id)
              {
                  $email = $sender_email = $form->getValue("sender_email");
                  $memebr = memberTable::getInstance()
                          ->findOneByEmailAddress($email);
                  if($member)
                  {
                      $member_id = $member->getId();
                      unset($member);
                  }
              }
              
              if($member_id)
              {
                  $ticket = new support_ticket();
                  $ticket->setMemberId($member_id);
                  $ticket->setTicketSubject("Member Query");                 
                  $ticket->setDateReceived(date('Y-m-d'));
                  $ticket->setStatus(support_ticketTable::STATUS_OPEN);
                  
                  $reply = new ticket_comment();
                  $reply->setSupportTicket($ticket);
                  $reply->setPublicMessage("".$form->getValue("message"));
                  $ticket->getTicketComment()->add($reply);
                  $ticket->save();
              }
              else
              {
                $sender_name = $form->getValue("sender_name");
                $sender_email = $form->getValue("sender_email");
                $message      =
                        "Name: ".$form->getValue("sender_name")."\n".
                        "Phone: ".$form->getValue("phone_number")."\n".
                        "Country: ".$form->getValue("country")."\n".
                        /*"City: ".$form->getValue("city")."\n".
                        "State: ".$form->getValue("state")."\n".
                        "Zip Code: ".$form->getValue("zip_code")."\n".
                        "Address1: ".$form->getValue("address1")."\n".
                        "Address2: ".$form->getValue("address2")."\n".*/
                        "Message: \n".
                        "=================================\n".
                        $form->getValue("message");

                $to      = 'nrihelp@groworth.in';
                $subject = 'Contact Us: Growth Real Solutions';              
                $headers = 'From: '.$sender_name.'<'.$sender_email. ">\r\n" . 
                        'Reply-To: '.$sender_name.'<'.$sender_email. ">\r\n" .
                        "Cc: contact@anvayatech.com\r\n".
                      'X-Mailer: PHP/' . phpversion();

                mail($to, $subject, $message, $headers);
              }
              $this->setTemplate('contactThanks');
          }
          else
          {
              $this->getUser()->setFlash('error','Your message could not be sent due to some errors.');
          }
      }   
      
      
      //$content = site_pageTable::getInstance()
                    //->find(3);
      /* @var $content site_page */
      //$this->content = $content->getPageContent();          
      $this->content = "";
      
      $this->form = $form;
  }
  
  public function executeConfirmPay(sfWebRequest $request)
  {      
    $this->forward404Unless($request->hasParameter("mid"));
    $user_id = $request->getParameter("mid");
    $submission = submissionTable::getInstance()
                    ->findOneByUserIdAndFormId($user_id, 2, null);
    
    /* @var $submission submission */
    if($submission->getPayment()->count()>0)
    {
        $this->forward404();
    }
    
    $subscription = member_subscriptionTable::getInstance()
                                ->createQuery('ms')
                                ->addWhere('ms.member_id = ?', $user_id)
                                ->orderBy('ms.id desc')
                                ->fetchOne();
            
    /* @var $subscription member_subscription */
    if($subscription)
    {
        $subscription_id = $subscription->getId();
        $amount = $subscription->getPrice();
    }
    else
    {
        $subscription_id  = null;
        $amount = "750";
    }
    
    $payment = new payment();
    $payment->setMemberId($user_id);
    $payment->setSubmission($submission);
    $this->form = new paymentForm($payment, array("submission_id"=>$submission->getId(), "subscription_id"=>$subscription_id, "ip_address"=>  ip2long($request->getRemoteAddress()), "member_id"=>$user_id,"amount"=>$amount ) );      
  }
  
  public function executeConfirmPayUpdate(sfWebRequest $request)
  {           
     $form = new paymentForm();            
     
     $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
     
     if ($form->isValid())
     {
         $payment = $form->save();                
         
         try
         {
            $email_body = $this->getPartial("default/email_pay_alert", array("payment"=>$payment) );
            $msg = $this->getMailer()->compose();
            $msg->setSubject("Growroth.in: Subscription Payment Alert");
            $msg->addFrom("nriservices@groworth.in","Groworth Real Solutions Pvt. Ltd");
            $msg->addReplyTo("nrihelp@groworth.in", "Groworth Real Solutions Pvt. Ltd");
            $msg->addTo("sandeep.groworth@gmail.com","Sandeep Ghadge");
            $msg->addCc("mrugendrabhure@gmail.com", "Mrugendra Bhure");
            $msg->setBody($email_body, 'text/html', "utf-8");
            $this->getMailer()->sendNextImmediately();
            $this->getMailer()->send($msg);
         }catch(Exception $ex)
         {
             
         }
         
         $this->payment = $payment;
         $this->redirect("default/payThanks");
     }
     else
     {
         $this->form = $form;
         $this->setTemplate("confirmPay");         
     }
     
     return sfView::SUCCESS;
  }
  
  public function executePayThanks(sfWebRequest $request)
  {
      
  }
  
  public function executeThankyou(sfWebRequest $request)
  {
     
  }
}
