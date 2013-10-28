<?php

/**
 * payment filter form base class.
 *
 * @package    BestBuddies
 * @subpackage filter
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasepaymentFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'member_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('member'), 'add_empty' => true)),
      'submission_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('submission'), 'add_empty' => true)),
      'payment_type'   => new sfWidgetFormFilterInput(),
      'payment_date'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'bank_name'      => new sfWidgetFormFilterInput(),
      'branch'         => new sfWidgetFormFilterInput(),
      'payment_ref_no' => new sfWidgetFormFilterInput(),
      'transaction_id' => new sfWidgetFormFilterInput(),
      'amount'         => new sfWidgetFormFilterInput(),
      'routed_through' => new sfWidgetFormFilterInput(),
      'status'         => new sfWidgetFormFilterInput(),
      'ip_address'     => new sfWidgetFormFilterInput(),
      'created_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'member_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('member'), 'column' => 'id')),
      'submission_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('submission'), 'column' => 'id')),
      'payment_type'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'payment_date'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'bank_name'      => new sfValidatorPass(array('required' => false)),
      'branch'         => new sfValidatorPass(array('required' => false)),
      'payment_ref_no' => new sfValidatorPass(array('required' => false)),
      'transaction_id' => new sfValidatorPass(array('required' => false)),
      'amount'         => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'routed_through' => new sfValidatorPass(array('required' => false)),
      'status'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ip_address'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('payment_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'payment';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'member_id'      => 'ForeignKey',
      'submission_id'  => 'ForeignKey',
      'payment_type'   => 'Number',
      'payment_date'   => 'Date',
      'bank_name'      => 'Text',
      'branch'         => 'Text',
      'payment_ref_no' => 'Text',
      'transaction_id' => 'Text',
      'amount'         => 'Number',
      'routed_through' => 'Text',
      'status'         => 'Number',
      'ip_address'     => 'Number',
      'created_at'     => 'Date',
      'updated_at'     => 'Date',
    );
  }
}
