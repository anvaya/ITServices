<?php
/**
 * Collection of Options for the question bank - Subform for the question bank form.
 *
 * @author Mrugendra Bhure
 */
class email_directoryCollectionForm extends sfForm
{
    public function configure() 
    {
      $this->widgetSchema['name'] = new sfWidgetFormInputText();
      $this->setDefault('name', $this->getOption('name'));
      $this->validatorSchema['name'] = new sfValidatorPass();
      $this->widgetSchema['email'] = new sfWidgetFormInputText();
      $this->setDefault('email', $this->getOption('email'));
      $this->validatorSchema['email'] = new sfValidatorEmail(array('required'=>FALSE));
      
      //$this->mergePostValidator();
      // add a post validator
      $this->validatorSchema->setPostValidator(
        new sfValidatorCallback(array('callback' => array($this, 'checkNameEmail')))
      );
    }
    
    public function addDetailRow($key)
    {
    }
    
    public function checkNameEmail($validator, $values)
    {
      if((trim($values['name']) != "" && trim($values['email']) == "") || (trim($values['name']) == "" && trim($values['email']) != ""))
      {
        // value is not correct, throw an error
        throw new sfValidatorError($validator, 'Add Email and Name');
      }

      // value is correct, return the clean values
      return $values;
    }
      
}

?>
