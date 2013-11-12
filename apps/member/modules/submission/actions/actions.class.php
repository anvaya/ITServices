<?php

require_once dirname(__FILE__).'/../lib/submissionGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/submissionGeneratorHelper.class.php';

/**
 * submission actions.
 *
 * @package    BestBuddies
 * @subpackage submission
 * @author     Anvaya Technologies
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class submissionActions extends autoSubmissionActions
{
  public function executeItrone(sfWebRequest $request)
  {
    $sub = new submission();
    $this->itrone_form = new ItroneForm($sub,$request->getParameter('itrone'));
    
    if ($request->isMethod('post'))
    {
      $captcha = array(
            'recaptcha_challenge_field' => $request->getParameter('recaptcha_challenge_field'),
            'recaptcha_response_field'  => $request->getParameter('recaptcha_response_field')
             );
                  
      //$this->form->bind($request->getParameter($this->form->getName()));
      $this->itrone_form->bind(array_merge($request->getParameter('itrone'), array('captcha' => $captcha)));

      if ($this->itrone_form->isValid())
      {
        $sf_guard_user = Doctrine::getTable('sfGuardUser')->find($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'));
        $arr_subform = $this->itrone_form->getValues();
        //print_r($arr_subform);exit;
        /* @var $submission submission */
        $submission = new submission();
        $submission->setFormId(2);
        $submission->setUserId($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'));
        $submission->setSubmissionIp(ip2long($this->getRealIpAddress()));
        $submission->save();
        $submission_id = $submission->getId(); 
        
        
        /* @var $submission_data submission_data */
        foreach($arr_subform as $key => $value)
        {
            if($key == "itrone_subs" || $key == 'captcha')
              continue;
            
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
        
        $itrone_subs = $arr_subform['itrone_subs'];
        foreach($itrone_subs as $keys => $emb_form)
        {
          /* @var $submission_inner submission_inner */
          $submission_inner = new submission_inner();
          $submission_inner->setSubmissionId($submission_id);
          $submission_inner->setFormId(3);
          $submission_inner->setUserId($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'));
          $submission_inner->setSubmissionIp(ip2long($this->getRealIpAddress()));
          $submission_inner->save();
          $submission_inner_id = $submission_inner->getId(); 
            
          foreach($emb_form as $key => $value)
          {

            /* @var $submission_inner_data submission_inner_data */
            $q_id = explode("_", $key);
            if((is_array($value) || (!is_array($value) && trim($value) != "")) && is_numeric($q_id[1]))
            {
              $sd_id = 0;
              $submission_inner_data = Doctrine_Query::create()
                  ->from('submission_inner_data')
                  ->where('submission_inner_id = ?', $submission_inner_id)
                  ->andWhere('question_id = ?', $q_id[1])
                  ->fetchOne();
              if(!$submission_inner_data)
                $submission_inner_data = new submission_inner_data();
              
              $submission_inner_data->setSubmissionInnerId($submission_inner_id);
              $submission_inner_data->setQuestionId($q_id[1]);
              if($q_id[2] == questionTable::ANSWER_TYPE_SINGLE_CHOICE || $q_id[2] == questionTable::ANSWER_TYPE_SINGLE_CHOICE_WITH_TEXT || $q_id[2] == questionTable::ANSWER_TYPE_MULTI_CHOICE_WITH_TEXT || $q_id[2] == questionTable::ANSWER_TYPE_MULTI_CHOICE || questionTable::ANSWER_TYPE_SELECT)
              {
                  if(count($q_id) == 4 && $q_id[3] == 'answertext')
                  {
                    $submission_inner_data->setAnswserText($value);
                  }
                  else
                  {
                    if(!is_array($value))
                      $v = array($value);
                    $submission_inner_data->setSelectedOptions(serialize($value));
                  }
              }
              else
                $submission_inner_data->setAnswserText($value);
              $submission_inner_data->save();
            }
          }
        }

        $this->redirect("submission/thankyou");
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
  
  public function executeAdditronesub(sfWebRequest $request)
  {
      $id = $request->getParameter('id', false);
      $num = $request->getParameter('num');

      if(!$id)
      {
          $sv = new submission();
      }
      else
          $sv = Doctrine::getTable('submission')
                  ->find($id);

      $this->form = new ItroneForm($sv);

      $subform = $this->form->getEmbeddedForm("itrone_subs");

      /* @var $subform slideshowImagesCollectionForm */
      $detail  = $subform->addDetailRow($num);

      if(!$detail)
      {
          $response = $this->getResponse();
          $response->setStatusCode(400, "Invalid");
          return sfView::NONE;
      }

      $this->form->embedForm('itrone_subs', $subform);

      return $this->renderPartial("addnewsubform",array("form"=>$this->form ,'number' => $num));
  }
  
  public function executeItroneedit(sfWebRequest $request)
  {
    $sub = Doctrine::getTable('submission')->find($request->getParameter('id'));
    $this->itrone_form = new ItroneForm($sub,$request->getParameter('itrone'));
    $this->setTemplate('itrone');
    
    if ($request->isMethod('post'))
    {
      $captcha = array(
            'recaptcha_challenge_field' => $request->getParameter('recaptcha_challenge_field'),
            'recaptcha_response_field'  => $request->getParameter('recaptcha_response_field')
             );
                  
      //$this->form->bind($request->getParameter($this->form->getName()));
      $this->itrone_form->bind(array_merge($request->getParameter('itrone'), array('captcha' => $captcha)));

      if ($this->itrone_form->isValid())
      {
        $sf_guard_user = Doctrine::getTable('sfGuardUser')->find($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'));
        $arr_subform = $this->itrone_form->getValues();
        print_r($arr_subform);exit;
        /* @var $submission submission */
        $submission = new submission();
        $submission->setFormId(2);
        $submission->setUserId($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'));
        $submission->setSubmissionIp(ip2long($this->getRealIpAddress()));
        $submission->save();
        $submission_id = $submission->getId(); 
        
        
        /* @var $submission_data submission_data */
        foreach($arr_subform as $key => $value)
        {
            if($key == "itrone_subs" || $key == 'captcha')
              continue;
            
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
        
        $itrone_subs = $arr_subform['itrone_subs'];
        foreach($itrone_subs as $keys => $emb_form)
        {
          /* @var $submission_inner submission_inner */
          $submission_inner = new submission_inner();
          $submission_inner->setSubmissionId($submission_id);
          $submission_inner->setFormId(3);
          $submission_inner->setUserId($this->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser'));
          $submission_inner->setSubmissionIp(ip2long($this->getRealIpAddress()));
          $submission_inner->save();
          $submission_inner_id = $submission_inner->getId(); 
            
          foreach($emb_form as $key => $value)
          {

            /* @var $submission_inner_data submission_inner_data */
            $q_id = explode("_", $key);
            if((is_array($value) || (!is_array($value) && trim($value) != "")) && is_numeric($q_id[1]))
            {
              $sd_id = 0;
              $submission_inner_data = Doctrine_Query::create()
                  ->from('submission_inner_data')
                  ->where('submission_inner_id = ?', $submission_inner_id)
                  ->andWhere('question_id = ?', $q_id[1])
                  ->fetchOne();
              if(!$submission_inner_data)
                $submission_inner_data = new submission_inner_data();
              
              $submission_inner_data->setSubmissionInnerId($submission_inner_id);
              $submission_inner_data->setQuestionId($q_id[1]);
              if($q_id[2] == questionTable::ANSWER_TYPE_SINGLE_CHOICE || $q_id[2] == questionTable::ANSWER_TYPE_SINGLE_CHOICE_WITH_TEXT || $q_id[2] == questionTable::ANSWER_TYPE_MULTI_CHOICE_WITH_TEXT || $q_id[2] == questionTable::ANSWER_TYPE_MULTI_CHOICE || questionTable::ANSWER_TYPE_SELECT)
              {
                  if(count($q_id) == 4 && $q_id[3] == 'answertext')
                  {
                    $submission_inner_data->setAnswserText($value);
                  }
                  else
                  {
                    if(!is_array($value))
                      $v = array($value);
                    $submission_inner_data->setSelectedOptions(serialize($value));
                  }
              }
              else
                $submission_inner_data->setAnswserText($value);
              $submission_inner_data->save();
            }
          }
        }

        $this->redirect("submission/thankyou");
      }
    }
    
  }
}
