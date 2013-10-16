<?php

/**
 * country form base class.
 *
 * @method country getObject() Returns the current form's model object
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasecountryForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'country_code' => new sfWidgetFormInputHidden(),
      'disabled'     => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'country_code' => new sfValidatorChoice(array('choices' => array($this->getObject()->get('country_code')), 'empty_value' => $this->getObject()->get('country_code'), 'required' => false)),
      'disabled'     => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'country', 'column' => array('country_code')))
    );

    $this->widgetSchema->setNameFormat('country[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'country';
  }

}
