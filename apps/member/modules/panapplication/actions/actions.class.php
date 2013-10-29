<?php
require_once sfConfig::get('sf_lib_dir')."/vendor/anvaya/util.php";

/**
 * panapplication actions.
 *
 * @package    BestBuddies
 * @subpackage panapplication
 * @author     Anvaya Technologies
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */

class panapplicationActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->sub_form = new RegisterSubForm($request->getParameter('subform'));
    

    if ($request->isMethod('post'))
    {
      $captcha = array(
            'recaptcha_challenge_field' => $request->getParameter('recaptcha_challenge_field'),
            'recaptcha_response_field'  => $request->getParameter('recaptcha_response_field')
             );
                  
      //$this->form->bind($request->getParameter($this->form->getName()));
      $this->sub_form->bind(array_merge($request->getParameter('subform'), array('captcha' => $captcha)));

      if ($this->sub_form->isValid())
      {
        $sf_guard_user = Doctrine::getTable('sfGuardUser')->find($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'));
        $arr_subform = $this->sub_form->getValues();               
        
        /* @var $submission submission */
        $submission = new submission();
        $submission->setFormId(1);
        $submission->setUserId($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'));
        $submission->setSubmissionIp(ip2long($this->getRealIpAddress()));
        $submission->setStatus(pan_applicationTable::STATUS_TYPE_PAYMENT_PENDING);
        $submission->save();
        $submission_id = $submission->getId(); 
        
        /* @var $submission_data submission_data */
        foreach($arr_subform as $key => $value)
        {
            $q_id = explode("_", $key);
            if((is_array($value) || (!is_array($value) && trim($value) != "")) && is_numeric($q_id[1]))
            {
              $sd_id = 0;
              $submission_data = Doctrine_Query::create()
                  ->from('submission_data')
                  ->where('submission_id = ?', $submission_id)
                  ->andWhere('question_id = ?', $q_id[1])
                  ->fetchOne();
              if(!$submission_data)
                $submission_data = new submission_data();
              
              $submission_data->setSubmissionId($submission_id);
              $submission_data->setQuestionId($q_id[1]);
              if($q_id[2] == questionTable::ANSWER_TYPE_SINGLE_CHOICE || $q_id[2] == questionTable::ANSWER_TYPE_SINGLE_CHOICE_WITH_TEXT || $q_id[2] == questionTable::ANSWER_TYPE_MULTI_CHOICE_WITH_TEXT || $q_id[2] == questionTable::ANSWER_TYPE_MULTI_CHOICE || questionTable::ANSWER_TYPE_SELECT)
              {
                  if(count($q_id) == 4 && $q_id[3] == 'answertext')
                  {
                    $submission_data->setAnswserText($value);
                  }
                  else
                  {
                    if(!is_array($value))
                      $v = array($value);
                    $submission_data->setSelectedOptions(serialize($value));
                  }
              }
              else
                $submission_data->setAnswserText($value);
              $submission_data->save();
            }
        }
	
        $encryption_key = sfConfig::get('sf_mail_encryption_key');
        $submission_info = array($submission_id, $this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'));
        $serialized  = serialize($submission_info);
        $encrypted   = RIJNDAEL_encrypt($serialized, $encryption_key);
        $link        = urlencode($encrypted);
        
        $admin_email = SettingsTable::getValue('admin_email');
        $email_body = get_partial("panapplication/paymentnotification_email_body", array("sf_guard_user" => $sf_guard_user, "submission" => $submission, "link" => $link));
        $subject  = "ITservices:: Your pan application successfully submit please pay the payment";
        // Additional headers
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: It Services <'.$admin_email.'>' . "\r\n";
        //$headers .= 'Cc: contact@anvayatech.com' . "\r\n";
        $headers .= 'Cc: keval23@gmail.com' . "\r\n";
        //$headers .= 'To: '. $member->getFirstName()."<". $member->getEmailAddress().">". "\r\n";
        $to = $sf_guard_user->getFirstName()."<". $sf_guard_user->getEmailAddress().">";
        $result = @mail($to, $subject, $email_body, $headers);
        if($result)
        {
          $this->getUser()->setFlash('notice', 'The pan application was created successfully');
        }
        else
        {
          $this->logMessage("pancard application mail not sent to applicant member",'notice');
        }  

        $this->redirect("panapplication/thankyou");
      }
    }
  }
  
  private function getRealIpAddress()
	{
	    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
	    {
	      $ip=$_SERVER['HTTP_CLIENT_IP'];
	    }
	    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
	    {
	      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
	    }
	    else
	    {
	      $ip=$_SERVER['REMOTE_ADDR'];
	    }
	    return $ip;
	}

  public function executeThankyou(sfWebRequest $request)
  {
    
  }

  public function executePaymentVerified(sfWebRequest $request)
  {
    $admin_email = SettingsTable::getValue('admin_email');
    $this->flg = "";
    //$invitation_key = $request->getParameter('verify', false);
    //$invitation_key = urldecode($invitation_key);
    $invitation_key = urldecode("hoqIWIDTq7VnuS8NCz%2BGIMCDc2hQYGROdzliCRgC%2Blw%3D");
     
     if(!$invitation_key)
     {
         $this->forward404();
     }
     
     try
     {         
         $submission_info = unserialize(RIJNDAEL_decrypt($invitation_key, sfConfig::get('sf_mail_encryption_key')));
         
         $submission_id = $submission_info[0];
         $user_id   = $submission_info[1];
         
         if(!$submission_id)
             $this->flg = "The page you were looking for is no longer here.<br/>You can go back to <a href='".url_for('@homepage')."'>Home page</a> or contact us on ".$admin_email.", if you need an answer to your question. Sorry.";
             
         $submission = Doctrine::getTable('submission')->findOneByIdAndUserId($submission_id, $user_id);
         if(!$submission)
         {
             $this->flg = "The page you were looking for is no longer here.<br/>You can go back to <a href='".url_for('@homepage')."'>Home page</a> or contact us on ".$admin_email.", if you need an answer to your question. Sorry.";
         }
         else if($submission->getStatus() > 1)
         {
             $this->flg = "<h2>Thank you</h2><br/>You have already sent payment for pan application.<br/>We appreciate your continuing business, and we look forward to hearing from you shortly.";
         }
           
         $this->form = new paymentForm(null,array('member_id' => $user_id, 'submission_id' => $submission_id, 'status' => 2,'ip_address'=> ip2long($this->getRealIpAddress())));
     }catch(Exception $e)
     {
       //$this->flg = "Execption :".$e;
       $this->flg = "Illegal process, please try again";
     }
  }
  
  public function executePaymentconfirmed(sfWebRequest $request)
  {
    $flg = 1;

    $this->form = new paymentForm();
    $this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
    if ($this->form->isValid())
    {
      $notice = 'The payment was confirmed successfully.';

      try {
        $payment = $this->form->save();
        $user_id = $payment->getMemberId();
        $submission_id = $payment->getSubmissionId();

        $submission = Doctrine::getTable('submission')->find($submission_id);
        $submission->setStatus(2);
        $submission->save();
        
        $sf_guard_user = Doctrine::getTable('sfGuardUser')->find($user_id);
        $settings = Doctrine::getTable('settings')->find('admin_email');
        
        //email send to admin
        $email_body = get_partial("panapplication/paymentconfirmend_email_body", array("sf_guard_user" => $sf_guard_user, "payment" => $payment));
        $subject  = "ITservices:: One pan application payment received";
        // Additional headers
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        //$headers .= 'To: '. $member->getFirstName()."<". $member->getEmailAddress().">". "\r\n";
        $headers .= "From: ".$sf_guard_user->getFirstName()." <".$sf_guard_user->getEmailAddress().">" . "\r\n";
        //$headers .= 'Cc: contact@anvayatech.com' . "\r\n";
        $headers .= 'Cc: keval23@gmail.com' . "\r\n";
        $to = 'It Services <'.$settings->getValue1().'>';
        
        $result = @mail($to, $subject, $email_body, $headers);
        if($result)
        {
          $this->getUser()->setFlash('notice', 'The pan application payment confirmation sent successfully');
        }
        else
        {
          $this->logMessage("pancard application  payment confirmend mail not sent to admin",'notice');
        }  
        //email send to customer
        $email_body = get_partial("panapplication/paymentconfirmend_applicatint_email_body", array("sf_guard_user" => $sf_guard_user, "payment" => $payment));
        
        $subject  = "ITservices:: payment received mail copy";
        // Additional headers
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        //$headers .= 'To: '. $member->getFirstName()."<". $member->getEmailAddress().">". "\r\n";
        
        $headers .= 'From: It Services <'.$settings->getValue1().'>' . "\r\n";
        //$headers .= 'Cc: contact@anvayatech.com' . "\r\n";
        $headers .= 'Cc: keval23@gmail.com' . "\r\n";
        //$headers .= 'To: '. $member->getFirstName()."<". $member->getEmailAddress().">". "\r\n";
        $to = $sf_guard_user->getFirstName()."<". $sf_guard_user->getEmailAddress().">";
        //$headers .= 'Cc: contact@anvayatech.com' . "\r\n";
        
        $result = @mail($to, $subject, $email_body, $headers);
        if($result)
        {
          $this->getUser()->setFlash('notice', 'The pan application payment confirmation sent successfully');
        }
        else
        {
          $this->logMessage("pancard application  payment confirmation mail not sent to user",'notice');
        }  
        $flg =2;
      } catch (Doctrine_Validator_Exception $e) {

        $flg = 1;
        $errorStack = $this->form->getObject()->getErrorStack();

        $message = get_class($this->form->getObject()) . ' has ' . count($errorStack) . " field" . (count($errorStack) > 1 ?  's' : null) . " with validation errors: ";
        foreach ($errorStack as $field => $errors) {
            $message .= "$field (" . implode(", ", $errors) . "), ";
        }
        $message = trim($message, ', ');
        $this->getUser()->setFlash('error', $message);
        $this->logMessage("pancard application  payment confirmend ".$e->getMessage(),'notice');

      }

      $this->getUser()->setFlash('notice', $notice);

    }
    else
    {
      $flg = 0;
      $this->getUser()->setFlash('error', 'The payment has not been confirmed due to some errors.');
      $this->setTemplate('paymentVerified');
      return sfView::SUCCESS;
    }
    
    if($flg > 0)
      $this->redirect("panapplication/paymentnotification/flg/$flg");
  }
  
  public function executePaymentnotification(sfWebRequest $request)
  {
    $flg = $request->getParameter('flg');
    if($flg == 1)
      $this->setTemplate('paymentnotificationerror');
  }  
}
