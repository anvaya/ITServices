<?php

/**
 * email_directory form base class.
 *
 * @method email_directory getObject() Returns the current form's model object
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class Baseemail_directoryForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'directory_key'  => new sfWidgetFormInputHidden(),
      'title'          => new sfWidgetFormInputText(),
      'send_to'        => new sfWidgetFormTextarea(),
      'email_subject'  => new sfWidgetFormInputText(),
      'email_template' => new sfWidgetFormInputText(),
      'is_html'        => new sfWidgetFormInputCheckbox(),
      'created_at'     => new sfWidgetFormDateTime(),
      'updated_at'     => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'directory_key'  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('directory_key')), 'empty_value' => $this->getObject()->get('directory_key'), 'required' => false)),
      'title'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'send_to'        => new sfValidatorString(array('max_length' => 4000, 'required' => false)),
      'email_subject'  => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'email_template' => new sfValidatorPass(array('required' => false)),
      'is_html'        => new sfValidatorBoolean(array('required' => false)),
      'created_at'     => new sfValidatorDateTime(),
      'updated_at'     => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('email_directory[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'email_directory';
  }

}
