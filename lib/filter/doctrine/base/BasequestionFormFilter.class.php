<?php

/**
 * question filter form base class.
 *
 * @package    BestBuddies
 * @subpackage filter
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasequestionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'answer_type'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'question_text'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'help_message'       => new sfWidgetFormFilterInput(),
      'parent_question_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ParentQuestion'), 'add_empty' => true)),
      'disabled'           => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'answer_type'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'question_text'      => new sfValidatorPass(array('required' => false)),
      'help_message'       => new sfValidatorPass(array('required' => false)),
      'parent_question_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ParentQuestion'), 'column' => 'id')),
      'disabled'           => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('question_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'question';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'answer_type'        => 'Number',
      'question_text'      => 'Text',
      'help_message'       => 'Text',
      'parent_question_id' => 'ForeignKey',
      'disabled'           => 'Boolean',
    );
  }
}
