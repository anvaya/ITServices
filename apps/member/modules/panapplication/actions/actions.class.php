<?php

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
        $submission->save();
        $submission_id = $submission->getId(); 
        
        
        /* @var $application application */
        /*
        $application = new application();
        $application->setSubmissionId($submission_id);
        $application->setFirstName($sf_guard_user->getFirstName());
        $application->setLastName($sf_guard_user->getLastName());
        $application->setEmailAddress($sf_guard_user->getEmailAddress());
        $application->save();*/
        
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
}
