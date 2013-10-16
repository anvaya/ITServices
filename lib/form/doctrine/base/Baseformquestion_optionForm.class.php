<?php

/**
 * formquestion_option form base class.
 *
 * @method formquestion_option getObject() Returns the current form's model object
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class Baseformquestion_optionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'question_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('form_question'), 'add_empty' => true)),
      'option_value'  => new sfWidgetFormInputText(),
      'option_text'   => new sfWidgetFormInputText(),
      'pre_selected'  => new sfWidgetFormInputCheckbox(),
      'display_order' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'question_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('form_question'), 'required' => false)),
      'option_value'  => new sfValidatorPass(),
      'option_text'   => new sfValidatorPass(),
      'pre_selected'  => new sfValidatorBoolean(array('required' => false)),
      'display_order' => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('formquestion_option[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'formquestion_option';
  }

}
