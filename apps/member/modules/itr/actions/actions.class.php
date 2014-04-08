<?php

/**
 * itr actions.
 *
 * @package    BestBuddies
 * @subpackage itr
 * @author     Anvaya Technologies
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class itrActions extends sfActions
{
  public function preExecute() 
  {
      parent::preExecute();
      $this->member_id = $this->getUser()->getGuardUser()->getId();
  }  
    
  public function executeIndex(sfWebRequest $request)
  {
    $this->forward404();      
  }

  public function executeSubmitDone(sfWebRequest $request)
  {
      $this->forward404Unless($request->hasParameter('pid'));
      $this->product = productTable::getInstance()->find($request->getParameter('pid'));
  }
  
  public function executeSubmitDraftDone(sfWebRequest $request)
  {
      $this->forward404Unless($request->hasParameter('pid'));
      $this->product = productTable::getInstance()->find($request->getParameter('pid'));
  }
  
  public function executeNew(sfWebRequest $request)
  {
    $this->forward404Unless($request->hasParameter("pid"));
    $product = productTable::getInstance()
                ->find( $request->getParameter('pid') );
    
    $this->forward404If(!$product, "Invalid Request");
    
    ///TODO: Add check to see if the user has right to file this submission.    
    
    $existing = itr_submissionTable::getInstance()
                ->findOneByMemberIdAndProductId($this->member_id, $product->getId());
    
    if($existing && $existing->getId())
    {
        $this->redirect("itr/edit?id=".$existing->getId());
    }
    
    $member_id = $this->getUser()->getGuardUser()->getId();
    $product_id = $product->getId();
    $draft_path = sfConfig::get('sf_data_dir')."/itr_drafts/$member_id"."_".$product_id.".itr";
    
    if(file_exists($draft_path))
    {        
        try
        {
            $val_string = file_get_contents($draft_path);
            $form_values = unserialize($val_string);
            $itr_form = new itr_submissionForm();
            
            $itr_form->disableCSRFProtection();
            $itr_form->bind($form_values, array() );
            
            $this->form = $itr_form;
            
        }catch (Exception $ex) 
        {

        }
    }    
    
    if(!isset($this->form))
    {
        $itr = new itr_submission();

        $member = memberTable::getInstance()->find($this->member_id);
        /* @var $member member */

        $itr->setFirstName($member->getFirstName());
        $itr->setLastName($member->getLastName());
        $itr->setMiddleName($member->getMiddleName());
        $itr->setDob($member->getDob());
        $itr->setEmailAddress($member->getEmailAddress());
        $itr->setCountry($member->getCountry());
        $itr->setGender($member->getGender()=="M"?"1":"0");
        $itr->setPanNo($member->getPanNo());

        $address = addressTable::getInstance()
                    ->createQuery('aa')
                    ->addWhere('aa.member_id = ?', $this->member_id)
                    ->addWhere('aa.address_type = ?', addressTable::ADDRESS_TYPE_IND)
                    ->fetchOne();

        if($address)
        {
            /* @var $address address */
            $itr->setFlatNo($address->getFlatNo());
            $itr->setPremises($address->getPremises());
            $itr->setStreet($address->getStreet());
            $itr->setState($address->getState());
            $itr->setCity($address->getCity());
            $itr->setArea($address->getArea());
            $itr->setCountry($address->getCountry());
            $itr->setPin($address->getPin());
        }

        $phone = contactTable::getInstance()
                    ->createQuery('c')
                    ->addWhere('c.member_id = ?', $this->member_id)
                    ->addWhere('c.contact_type = ?', contactTable::CONTACT_TYPE_MOBILE)
                    ->addWhere('c.isd_code <> ?', '91')
                    ->fetchOne();

        if($phone)
        {
            /* @var $phone contact */
            $itr->setPhoneNo($phone->getIsdCode()." ".$phone->getContactText());
        }

        //Find old information
        $old_itr = itr_submissionTable::getInstance()
                    ->createQuery('is')
                    ->addWhere('is.member_id = ?', $member_id)
                    ->orderBy('is.id desc')
                    ->fetchOne();
        
        if($old_itr)
        {
            /* @var $old_itr itr_submission */
            $itr->setPanNo($old_itr->getPanNo());
            $itr->setFathersName($old_itr->getFathersName());
            $itr->setMothersName($old_itr->getMothersName());
            $itr->setBankAcNo($old_itr->getBankAcNo());
            $itr->setAcType($old_itr->getAcType());
            $itr->setIfscCode($old_itr->getIfscCode());
            $itr->setMicrCode($old_itr->getMicrCode());
            
            $old_properties = $old_itr->getItrProperty();
            foreach($old_properties as $pr)
            {
                /* @var $pr itr_property */
                $property = clone $pr;
                $property->setItrSubmission($itr);
                $itr->getItrProperty()->add($property);                
            }
        }
        
        $itr->setProduct($product);
        $this->form = new itr_submissionForm($itr);
    }
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new itr_submissionForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeProcessing(sfWebRequest $request)
  {
      $this->forward404Unless($request->hasParameter('pid'));
      $this->product = productTable::getInstance()->find($request->getParameter('pid'));
  }
  
  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($itr_submission = Doctrine_Core::getTable('itr_submission')->find(array($request->getParameter('id'))), sprintf('Object itr_submission does not exist (%s).', $request->getParameter('id')));
    if($itr_submission->getMemberId() != $this->member_id )
    {
        $this->forward404();
    }
    
    if($itr_submission->getStatus() && $itr_submission->getStatus() >= 1)
    {
        $this->redirect("itr/processing?pid=".$itr_submission->getProductId());        
    }
    
    $member_id = $this->getUser()->getGuardUser()->getId();
    $product_id = $itr_submission->getProductId();
    $draft_path = sfConfig::get('sf_data_dir')."/itr_drafts/$member_id"."_".$product_id.".itr";
    
    $this->form = new itr_submissionForm($itr_submission);
    
    if(file_exists($draft_path))
    {        
        try
        {
            $val_string = file_get_contents($draft_path);
            if(strlen($val_string)>0)
            {
                $form_values = unserialize($val_string);                        
                $this->form->bind($form_values, array() );            
            }
            
        }catch (Exception $ex) 
        {

        }
    }    
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($itr_submission = Doctrine_Core::getTable('itr_submission')->find(array($request->getParameter('id'))), sprintf('Object itr_submission does not exist (%s).', $request->getParameter('id')));
    $this->form = new itr_submissionForm($itr_submission);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $this->forward404();  
    $request->checkCSRFProtection();

    $this->forward404Unless($itr_submission = Doctrine_Core::getTable('itr_submission')->find(array($request->getParameter('id'))), sprintf('Object itr_submission does not exist (%s).', $request->getParameter('id')));
    $itr_submission->delete();

    $this->redirect('itr/index');
  }

  public function executeSelectYear(sfWebRequest $request)
  {
      $this->forward404Unless(($request->hasParameter('itr_year')));
      $itr_product_id = $request->getParameter('itr_year');
      $product = productTable::getInstance()
              ->find($itr_product_id);
      
      if($product)
      {
          $member_id = $this->getUser()->getGuardUser()->getId();
          
          $subscription = member_subscriptionTable::getInstance() 
                            ->createQuery('ms')
                            ->addWhere('member_id = ?', $member_id)
                            ->addWhere('active = 1')
                            ->orderBy('id desc')
                            ->fetchOne();          
          
          /* @var $subscription member_subscription */
          if(!$subscription->getItrProductId())
          {
              $subscription->setItrProductId($product->getId());
              $subscription->save();
              $this->redirect("@default");
          }
      }      
      return sfView::NONE;
  }
  
  protected function processForm(sfWebRequest $request, sfForm $form)
  {   
    $form_values =  $request->getParameter($form->getName());
      
    if( $request->hasParameter('SaveAsDraft'))
    {
        $member_id = $this->getUser()->getGuardUser()->getId();
        $product_id = $form_values['product_id'];
        $save_path = sfConfig::get('sf_data_dir')."/itr_drafts/$member_id"."_".$product_id.".itr";
        file_put_contents($save_path, serialize($form_values) );
        $this->redirect('itr/submitDraftDone?pid='.$product_id);
    }           
        
    $form->bind($form_values, $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      try
      {        
        $itr_submission = $form->save();

        //Remove draft version
        try
        {
            /* @var $itr_submission itr_submission */
            $member_id = $this->getUser()->getGuardUser()->getId();
            $product_id = $itr_submission->getProductId();
            $draft_path = sfConfig::get('sf_data_dir')."/itr_drafts/$member_id"."_".$product_id.".itr";

            if(file_exists($draft_path))  
            {
                unlink($draft_path);
            }
        }catch (Exception $ex) 
        {

        }
      
        $this->redirect('itr/submitDone?pid='.$itr_submission->getProductId());
      }catch(Exception $ex)
      {
          $this->getUser()->addFlash('error','Your submission could not be saved due to some error.');          
          //TODO: Send Email to support informing of submission error.
      }      
    }
  }
}
