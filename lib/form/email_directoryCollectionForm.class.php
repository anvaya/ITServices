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
      $this->widgetSchema['email'] = new sfWidgetFormInputText();
      $this->setDefault('email', $this->getOption('email'));
      
      $this->mergePostValidator();
    }
    
    public function addDetailRow($key)
    {
    }
}

?>