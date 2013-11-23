<?php

/**
 * setting form base class.
 *
 * @method setting getObject() Returns the current form's model object
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasesettingForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'setting_key' => new sfWidgetFormInputText(),
      'description' => new sfWidgetFormInputText(),
      'value1'      => new sfWidgetFormInputText(),
      'value2'      => new sfWidgetFormInputText(),
      'value3'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'setting_key' => new sfValidatorPass(),
      'description' => new sfValidatorPass(array('required' => false)),
      'value1'      => new sfValidatorPass(array('required' => false)),
      'value2'      => new sfValidatorPass(array('required' => false)),
      'value3'      => new sfValidatorPass(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'setting', 'column' => array('setting_key')))
    );

    $this->widgetSchema->setNameFormat('setting[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'setting';
  }

}
