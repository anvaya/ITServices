<?php

/**
 * order filter form base class.
 *
 * @package    BestBuddies
 * @subpackage filter
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseorderFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'member_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('member'), 'add_empty' => true)),
      'order_no'            => new sfWidgetFormFilterInput(),
      'order_date'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'status'              => new sfWidgetFormFilterInput(),
      'gross_amount'        => new sfWidgetFormFilterInput(),
      'discount_amount'     => new sfWidgetFormFilterInput(),
      'discount_voucher_no' => new sfWidgetFormFilterInput(),
      'discount_percentage' => new sfWidgetFormFilterInput(),
      'tax_amount'          => new sfWidgetFormFilterInput(),
      'net_amount'          => new sfWidgetFormFilterInput(),
      'payment_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('payment'), 'add_empty' => true)),
      'created_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'member_id'           => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('member'), 'column' => 'id')),
      'order_no'            => new sfValidatorPass(array('required' => false)),
      'order_date'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'status'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'gross_amount'        => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'discount_amount'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'discount_voucher_no' => new sfValidatorPass(array('required' => false)),
      'discount_percentage' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'tax_amount'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'net_amount'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'payment_id'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('payment'), 'column' => 'id')),
      'created_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('order_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'order';
  }

  public function getFields()
  {
    return array(
      'id'                  => 'Number',
      'member_id'           => 'ForeignKey',
      'order_no'            => 'Text',
      'order_date'          => 'Date',
      'status'              => 'Number',
      'gross_amount'        => 'Number',
      'discount_amount'     => 'Number',
      'discount_voucher_no' => 'Text',
      'discount_percentage' => 'Number',
      'tax_amount'          => 'Number',
      'net_amount'          => 'Number',
      'payment_id'          => 'ForeignKey',
      'created_at'          => 'Date',
      'updated_at'          => 'Date',
    );
  }
}
