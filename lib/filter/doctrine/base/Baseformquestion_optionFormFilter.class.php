<?php

/**
 * formquestion_option filter form base class.
 *
 * @package    BestBuddies
 * @subpackage filter
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class Baseformquestion_optionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'question_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('form_question'), 'add_empty' => true)),
      'option_value'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'option_text'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'pre_selected'  => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'display_order' => new sfWidgetFormFilterInput(array('with_empty' => false)),
    ));

    $this->setValidators(array(
      'question_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('form_question'), 'column' => 'id')),
      'option_value'  => new sfValidatorPass(array('required' => false)),
      'option_text'   => new sfValidatorPass(array('required' => false)),
      'pre_selected'  => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'display_order' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('formquestion_option_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'formquestion_option';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'question_id'   => 'ForeignKey',
      'option_value'  => 'Text',
      'option_text'   => 'Text',
      'pre_selected'  => 'Boolean',
      'display_order' => 'Number',
    );
  }
}
