<?php

/**
 * faq form base class.
 *
 * @method faq getObject() Returns the current form's model object
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasefaqForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'       => new sfWidgetFormInputHidden(),
      'question' => new sfWidgetFormInputText(),
      'answer'   => new sfWidgetFormTextarea(),
      'ordering' => new sfWidgetFormInputText(),
      'active'   => new sfWidgetFormInputCheckbox(),
      'slug'     => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'question' => new sfValidatorPass(),
      'answer'   => new sfValidatorString(),
      'ordering' => new sfValidatorInteger(array('required' => false)),
      'active'   => new sfValidatorBoolean(array('required' => false)),
      'slug'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'faq', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('faq[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'faq';
  }

}
