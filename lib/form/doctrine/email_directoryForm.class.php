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
  
}
