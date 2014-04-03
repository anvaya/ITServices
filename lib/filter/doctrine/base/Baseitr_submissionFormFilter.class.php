<?php

/**
 * itr_submission filter form base class.
 *
 * @package    BestBuddies
 * @subpackage filter
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class Baseitr_submissionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'member_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('member'), 'add_empty' => true)),
      'product_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('product'), 'add_empty' => true)),
      'status'            => new sfWidgetFormFilterInput(),
      'first_name'        => new sfWidgetFormFilterInput(),
      'middle_name'       => new sfWidgetFormFilterInput(),
      'last_name'         => new sfWidgetFormFilterInput(),
      'dob'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'gender'            => new sfWidgetFormChoice(array('choices' => array('' => '', 'M' => 'M', 'F' => 'F', 'O' => 'O'))),
      'pan_no'            => new sfWidgetFormFilterInput(),
      'email_address'     => new sfWidgetFormFilterInput(),
      'phone_no'          => new sfWidgetFormFilterInput(),
      'fathers_name'      => new sfWidgetFormFilterInput(),
      'mothers_name'      => new sfWidgetFormFilterInput(),
      'flat_no'           => new sfWidgetFormFilterInput(),
      'premises'          => new sfWidgetFormFilterInput(),
      'street'            => new sfWidgetFormFilterInput(),
      'area'              => new sfWidgetFormFilterInput(),
      'city'              => new sfWidgetFormFilterInput(),
      'state'             => new sfWidgetFormFilterInput(),
      'country'           => new sfWidgetFormFilterInput(),
      'pin'               => new sfWidgetFormFilterInput(),
      'bank_ac_no'        => new sfWidgetFormFilterInput(),
      'ac_type'           => new sfWidgetFormFilterInput(),
      'ifsc_code'         => new sfWidgetFormFilterInput(),
      'micr_code'         => new sfWidgetFormFilterInput(),
      'notes'             => new sfWidgetFormFilterInput(),
      'tax_due'           => new sfWidgetFormFilterInput(),
      'due_date'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'payment_confirmed' => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'payment_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('payment'), 'add_empty' => true)),
      'ack_file'          => new sfWidgetFormFilterInput(),
      'created_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
    ));

    $this->setValidators(array(
      'member_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('member'), 'column' => 'id')),
      'product_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('product'), 'column' => 'id')),
      'status'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'first_name'        => new sfValidatorPass(array('required' => false)),
      'middle_name'       => new sfValidatorPass(array('required' => false)),
      'last_name'         => new sfValidatorPass(array('required' => false)),
      'dob'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'gender'            => new sfValidatorChoice(array('required' => false, 'choices' => array('M' => 'M', 'F' => 'F', 'O' => 'O'))),
      'pan_no'            => new sfValidatorPass(array('required' => false)),
      'email_address'     => new sfValidatorPass(array('required' => false)),
      'phone_no'          => new sfValidatorPass(array('required' => false)),
      'fathers_name'      => new sfValidatorPass(array('required' => false)),
      'mothers_name'      => new sfValidatorPass(array('required' => false)),
      'flat_no'           => new sfValidatorPass(array('required' => false)),
      'premises'          => new sfValidatorPass(array('required' => false)),
      'street'            => new sfValidatorPass(array('required' => false)),
      'area'              => new sfValidatorPass(array('required' => false)),
      'city'              => new sfValidatorPass(array('required' => false)),
      'state'             => new sfValidatorPass(array('required' => false)),
      'country'           => new sfValidatorPass(array('required' => false)),
      'pin'               => new sfValidatorPass(array('required' => false)),
      'bank_ac_no'        => new sfValidatorPass(array('required' => false)),
      'ac_type'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'ifsc_code'         => new sfValidatorPass(array('required' => false)),
      'micr_code'         => new sfValidatorPass(array('required' => false)),
      'notes'             => new sfValidatorPass(array('required' => false)),
      'tax_due'           => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'due_date'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'payment_confirmed' => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'payment_id'        => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('payment'), 'column' => 'id')),
      'ack_file'          => new sfValidatorPass(array('required' => false)),
      'created_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('itr_submission_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'itr_submission';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'member_id'         => 'ForeignKey',
      'product_id'        => 'ForeignKey',
      'status'            => 'Number',
      'first_name'        => 'Text',
      'middle_name'       => 'Text',
      'last_name'         => 'Text',
      'dob'               => 'Date',
      'gender'            => 'Enum',
      'pan_no'            => 'Text',
      'email_address'     => 'Text',
      'phone_no'          => 'Text',
      'fathers_name'      => 'Text',
      'mothers_name'      => 'Text',
      'flat_no'           => 'Text',
      'premises'          => 'Text',
      'street'            => 'Text',
      'area'              => 'Text',
      'city'              => 'Text',
      'state'             => 'Text',
      'country'           => 'Text',
      'pin'               => 'Text',
      'bank_ac_no'        => 'Text',
      'ac_type'           => 'Number',
      'ifsc_code'         => 'Text',
      'micr_code'         => 'Text',
      'notes'             => 'Text',
      'tax_due'           => 'Number',
      'due_date'          => 'Date',
      'payment_confirmed' => 'Boolean',
      'payment_id'        => 'ForeignKey',
      'ack_file'          => 'Text',
      'created_at'        => 'Date',
      'updated_at'        => 'Date',
    );
  }
}
