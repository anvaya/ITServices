<?php

class BasesfGuardRegisterActions extends sfActions
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
          $this->getUser()->signIn($user);

          $this->redirect('@homepage');
        }
      }
    }
    
    
  public function executeIndexOld(sfWebRequest $request)
  {
    if ($this->getUser()->isAuthenticated())
    {
      $this->getUser()->setFlash('notice', 'You are already registered and signed in!');
      $this->redirect('@homepage');
    }

    
    $this->form = new sfGuardRegisterForm();
    $this->sub_form = new RegisterSubForm($request->getParameter('subform'));
    

    if ($request->isMethod('post'))
    {
      $captcha = array(
            'recaptcha_challenge_field' => $request->getParameter('recaptcha_challenge_field'),
            'recaptcha_response_field'  => $request->getParameter('recaptcha_response_field')
             );
                  
      $this->form->bind($request->getParameter($this->form->getName()));
      $this->sub_form->bind(array_merge($request->getParameter('subform'), array('captcha' => $captcha)));


      if ($this->form->isValid() && $this->sub_form->isValid())
      {
        
        //echo "form is valid";
        $arr_subform = $this->sub_form->getValues();
        //exit;
        $user = $this->form->save();
        $user->setIsActive(0);
        $user->save();
        $sf_guard_user_id = $user->getId();
        
        /* @var $submission submission */
        $submission = new submission();
        $submission->setFormId(1);
        $submission->setUserId($sf_guard_user_id);
        $submission->setSubmissionIp(ip2long($this->getRealIpAddress()));
        $submission->save();
        $submission_id = $submission->getId(); 
        
        $sgu = $request->getParameter('sf_guard_user');
        
        /* @var $application application */
        $application = new application();
        $application->setSubmissionId($submission_id);
        $application->setProgramYearId($arr_subform['program_year_id']);
        $application->setFirstName($sgu['first_name']);
        $application->setLastName($sgu['last_name']);
        $application->setEmailAddress($sgu['email_address']);
        $application->save();
        
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
        //$this->getUser()->signIn($user);
        $this->redirect("sfGuardRegister/thankyou");
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