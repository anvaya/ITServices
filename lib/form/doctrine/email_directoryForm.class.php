<?php

/**
 * email_directory form.
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class email_directoryForm extends Baseemail_directoryForm
{
  public function configure()
  {
    $this->widgetSchema['email_template'] = new sfWidgetFormTextareaTinyMCE();
    $this->widgetSchema['email_template_plain'] = new sfWidgetFormTextarea();
    $this->setDefault('email_template_plain',$this->getObject()->getEmailTemplate());
    $this->validatorSchema['email_template_plain'] = new sfValidatorPass();
    
    $subForm = new sfForm();
    $arr_send_to = unserialize($this->getObject()->getSendTo());
    //print_r($arr_send_to);exit;
    for ($i = 0; $i < 5; $i++)
    {
      $form = new email_directoryCollectionForm(array(), isset($arr_send_to[$i])? $arr_send_to[$i]:array('name'=>'','email'=> ''));
      $subForm->embedForm($i, $form);
    }
    $this->embedForm('send_to_list', $subForm);
    
    unset($this['send_to'],$this['created_at'],$this['updated_at']);
     
    $this->validatorSchema->setOption('allow_extra_fields', true);
    
  }
  
  public function bind(array $taintedValues = null, array $taintedFiles= null)
  {
    // set column value from custom field value
    $email_template_plain = trim($taintedValues["email_template_plain"]);
    $email_template = trim($taintedValues ["email_template"]);
    if(isset($taintedValues["is_html"]))
    {
       $this->getObject()->setEmailTemplate($email_template);
       $taintedValues ["email_template"] = $email_template;
    }else{
       $this->getObject()->setEmailTemplate($email_template_plain);
       $taintedValues ["email_template"] = $email_template_plain;
    }
    parent::bind($taintedValues, $taintedFiles);

  }
}
