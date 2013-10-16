<?php

/**
 * question form base class.
 *
 * @method question getObject() Returns the current form's model object
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasequestionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'answer_type'        => new sfWidgetFormInputText(),
      'question_text'      => new sfWidgetFormInputText(),
      'help_message'       => new sfWidgetFormInputText(),
      'parent_question_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ParentQuestion'), 'add_empty' => true)),
      'disabled'           => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'answer_type'        => new sfValidatorInteger(),
      'question_text'      => new sfValidatorPass(),
      'help_message'       => new sfValidatorPass(array('required' => false)),
      'parent_question_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ParentQuestion'), 'required' => false)),
      'disabled'           => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('question[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'question';
  }

}
