<?php

require_once sfConfig::get('sf_plugins_dir') .'/sfDoctrineGuardPlugin/modules/sfGuardForgotPassword/lib/BasesfGuardForgotPasswordActions.class.php';

/**
 * sfGuardForgotPassword actions.
 * 
 * @package    sfGuardForgotPasswordPlugin
 * @subpackage sfGuardForgotPassword
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12534 2008-11-01 13:38:27Z Kris.Wallsmith $
 */
class sfGuardForgotPasswordActions extends BasesfGuardForgotPasswordActions
{
  
  public function executeIndex($request)
  {
    $this->form = new sfGuardRequestForgotPasswordForm();

    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getParameter($this->form->getName()));
      if ($this->form->isValid())
      {
        $this->user = $this->form->user;
        $this->_deleteOldUserForgotPasswordRecords();

        $forgotPassword = new sfGuardForgotPassword();
        $forgotPassword->user_id = $this->form->user->id;
        $forgotPassword->unique_key = md5(rand() + time());
        $forgotPassword->expires_at = new Doctrine_Expression('NOW()');
        $forgotPassword->save();

       $message = $this->getMailer()->compose()
          ->setFrom('nrihelp@groworth.in', 'Groworth Real Solutions Pvt. Ltd.')
          ->setTo($this->user->email_address)
          ->setSubject('Forgot Password Request for '.$this->form->user->username)
          ->setBody($this->getPartial('sfGuardForgotPassword/send_request', array('user' => $this->user, 'forgot_password' => $forgotPassword )))
          ->setContentType('text/html')              
        ;

        $this->getMailer()->send($message);

        $this->getUser()->setFlash('notice', 'Your request has been registered. Please check your email, you should receive a link shortly.');
        $this->redirect('@sf_guard_signin');
      } else {
        $this->getUser()->setFlash('error', 'Invalid e-mail address!');
      }
    }
  }
  
  public function executeChange($request)
  {
    $this->forgotPassword = $this->getRoute()->getObject();
    $this->user = $this->forgotPassword->User;
    $this->form = new sfGuardChangeUserPasswordForm($this->user);

    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getParameter($this->form->getName()));
      if ($this->form->isValid())
      {
        $this->form->save();

        $this->_deleteOldUserForgotPasswordRecords();

        $message = Swift_Message::newInstance()
          ->setFrom('nrihelp@groworth.in', 'Groworth Real Solutions Pvt. Ltd.')
          ->setTo($this->user->email_address)
          ->setSubject('New Password for '.$this->user->username)
          ->setBody($this->getPartial('sfGuardForgotPassword/new_password', array('user' => $this->user, 'password' => $request['sf_guard_user']['password'])))
          ->setContentType("text/html")
        ;

        $this->getMailer()->send($message);

        $this->getUser()->setFlash('notice', 'Password updated successfully!');
        $this->redirect('@sf_guard_signin');
      }
    }
  }
  
  private function _deleteOldUserForgotPasswordRecords()
  {
    Doctrine_Core::getTable('sfGuardForgotPassword')
      ->createQuery('p')
      ->delete()
      ->where('p.user_id = ?', $this->user->id)
      ->execute();
  }
 
}
