<?php

/**
 * itr_other_income filter form base class.
 *
 * @package    BestBuddies
 * @subpackage filter
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class Baseitr_other_incomeFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'submission_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('itr_submission'), 'add_empty' => true)),
      'category_id'   => new sfWidgetFormFilterInput(),
      'details'       => new sfWidgetFormFilterInput(),
      'date_rcvd'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'amount'        => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'submission_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('itr_submission'), 'column' => 'id')),
      'category_id'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'details'       => new sfValidatorPass(array('required' => false)),
      'date_rcvd'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'amount'        => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('itr_other_income_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'itr_other_income';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'submission_id' => 'ForeignKey',
      'category_id'   => 'Number',
      'details'       => 'Text',
      'date_rcvd'     => 'Date',
      'amount'        => 'Number',
    );
  }
}
