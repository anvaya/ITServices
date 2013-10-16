<?php

/**
 * submission_data filter form base class.
 *
 * @package    BestBuddies
 * @subpackage filter
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class Basesubmission_dataFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'submission_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('submission'), 'add_empty' => true)),
      'question_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('form_question'), 'add_empty' => true)),
      'answser_text'     => new sfWidgetFormFilterInput(),
      'selected_options' => new sfWidgetFormFilterInput(),
      'answer_files'     => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'submission_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('submission'), 'column' => 'id')),
      'question_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('form_question'), 'column' => 'id')),
      'answser_text'     => new sfValidatorPass(array('required' => false)),
      'selected_options' => new sfValidatorPass(array('required' => false)),
      'answer_files'     => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('submission_data_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'submission_data';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'submission_id'    => 'ForeignKey',
      'question_id'      => 'ForeignKey',
      'answser_text'     => 'Text',
      'selected_options' => 'Text',
      'answer_files'     => 'Text',
    );
  }
}
