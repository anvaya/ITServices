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
    
    $payment = new payment();
    $payment->setMemberId($user_id);
    $payment->setSubmission($submission);
    $this->form = new paymentForm($payment, array("submission_id"=>$submission->getId(),"ip_address"=>  ip2long($request->getRemoteAddress()), "member_id"=>$user_id,"amount"=>"750.00") );      
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
