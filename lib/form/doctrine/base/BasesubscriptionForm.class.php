<?php

/**
 * subscription form base class.
 *
 * @method subscription getObject() Returns the current form's model object
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasesubscriptionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'code'       => new sfWidgetFormInputText(),
      'name'       => new sfWidgetFormInputText(),
      'start_date' => new sfWidgetFormDate(),
      'end_date'   => new sfWidgetFormDate(),
      'currency'   => new sfWidgetFormInputText(),
      'price'      => new sfWidgetFormInputText(),
      'disabled'   => new sfWidgetFormInputCheckbox(),
      'template'   => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'code'       => new sfValidatorString(array('max_length' => 20)),
      'name'       => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'start_date' => new sfValidatorDate(array('required' => false)),
      'end_date'   => new sfValidatorDate(array('required' => false)),
      'currency'   => new sfValidatorString(array('max_length' => 3, 'required' => false)),
      'price'      => new sfValidatorNumber(array('required' => false)),
      'disabled'   => new sfValidatorBoolean(array('required' => false)),
      'template'   => new sfValidatorString(array('max_length' => 60, 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'subscription', 'column' => array('code')))
    );

    $this->widgetSchema->setNameFormat('subscription[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'subscription';
  }

}
