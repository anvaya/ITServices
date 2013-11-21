<?php

require_once dirname(__FILE__).'/../lib/BasesfGuardRegisterActions.class.php';

/**
 * sfGuardRegister actions.
 *
 * @package    guard
 * @subpackage sfGuardRegister
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z jwage $
 */
class sfGuardRegisterActions extends BasesfGuardRegisterActions
{
    public function executeIndex(sfWebRequest $request)
    {
      if ($this->getUser()->isAuthenticated())
      {
        $this->getUser()->setFlash('notice', 'You are already registered and signed in!');
        $this->redirect('@homepage');
      }

      $this->form = new sfGuardRegisterForm();

      if ($request->isMethod('post'))
      {
        $this->form->bind($request->getParameter($this->form->getName()));
        if ($this->form->isValid())
        {
          $user = $this->form->save();
          /* @var $user sfGuardUser */         
          $user->setIsMember(true);
          $user->setIsActive(false);
          $user->save();
          
          $submission = new submission();
          $submission->setUserId($user->getId());
          $submission->setFormId(2);
          $submission->setSubmissionIp(ip2long($request->getRemoteAddress()));
          $submission->save();
          
          $this->sendWelcomeEmail($user);
          $this->sendAdminAlert($user);
          //$this->getUser()->signIn($user);
          
          $this->redirect('default/thankyou');
        }
      }
    }
    
    public function executeThankYou(sfWebRequest $request)
    {
        
    }
    
    private function sendWelcomeEmail(sfguardUser $user)
    {
        try
        {
            $body = $this->getPartial("email_payment", array("user"=>$user));
            
            $msg = $this->getMailer()->compose();
            $msg->setSubject("Welcome: Please complete your registration");
            $msg->addFrom("nriservices@groworth.in","Groworth Real Solutions Pvt. Ltd");
            $msg->addReplyTo("nrihelp@groworth.in", "Groworth Real Solutions Pvt. Ltd");
            $msg->addTo($user->getEmailAddress() , $user->getFirstName() );            
            $msg->setBody($body, 'text/html', "utf-8");
            $this->getMailer()->sendNextImmediately();
            $this->getMailer()->send($msg);
            
            $msg = $this->getMailer()->compose();
            $msg->setSubject("Welcome: Please complete your registration");
            $msg->addFrom("nriservices@groworth.in","Groworth Real Solutions Pvt. Ltd");
            $msg->addReplyTo("nrihelp@groworth.in", "Groworth Real Solutions Pvt. Ltd");
            $msg->addTo("sandeep.groworth@gmail.com","Sandeep Ghadge");            
            $msg->addTo("mrugendrabhure@gmail.com","Mrugendra Bhure");            
            $msg->setBody($body, 'text/html', "utf-8");
            $this->getMailer()->sendNextImmediately();
            $this->getMailer()->send($msg);
            
        }catch (Exception $ex) 
        {
            $message = $ex->getMessage();
        }
    }
    
    private function sendAdminAlert(sfGuardUser $user)
    {
        try
        {
            $body = $this->getPartial("email_register_alert", array("user"=>$user));
            
            $msg = $this->getMailer()->compose();
            $msg->setSubject("Groworth.in: New User Registerd");
            $msg->addFrom("nriservices@groworth.in","Groworth Real Solutions Pvt. Ltd");
            $msg->addReplyTo("nrihelp@groworth.in", "Groworth Real Solutions Pvt. Ltd");
            $msg->addTo("sandeep.groworth@gmail.com","Sandeep Ghadge");
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