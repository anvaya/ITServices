<?php

/**
 * settings form base class.
 *
 * @method settings getObject() Returns the current form's model object
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasesettingsForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'setting_key' => new sfWidgetFormInputHidden(),
      'value1'      => new sfWidgetFormInputText(),
      'value2'      => new sfWidgetFormInputText(),
      'value3'      => new sfWidgetFormInputText(),
      'description' => new sfWidgetFormInputText(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'setting_key' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('setting_key')), 'empty_value' => $this->getObject()->get('setting_key'), 'required' => false)),
      'value1'      => new sfValidatorPass(array('required' => false)),
      'value2'      => new sfValidatorPass(array('required' => false)),
      'value3'      => new sfValidatorPass(array('required' => false)),
      'description' => new sfValidatorPass(array('required' => false)),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'settings', 'column' => array('setting_key')))
    );

    $this->widgetSchema->setNameFormat('settings[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'settings';
  }

}
