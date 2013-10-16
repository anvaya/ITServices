<?php

/**
 * submission_data form base class.
 *
 * @method submission_data getObject() Returns the current form's model object
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class Basesubmission_dataForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'submission_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('submission'), 'add_empty' => false)),
      'question_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('form_question'), 'add_empty' => true)),
      'answser_text'     => new sfWidgetFormInputText(),
      'selected_options' => new sfWidgetFormInputText(),
      'answer_files'     => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'submission_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('submission'))),
      'question_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('form_question'), 'required' => false)),
      'answser_text'     => new sfValidatorPass(array('required' => false)),
      'selected_options' => new sfValidatorPass(array('required' => false)),
      'answer_files'     => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('submission_data[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'submission_data';
  }

}
