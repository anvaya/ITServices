<?php

/**
 * itr_submission form base class.
 *
 * @method itr_submission getObject() Returns the current form's model object
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class Baseitr_submissionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'member_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('member'), 'add_empty' => true)),
      'product_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('product'), 'add_empty' => true)),
      'status'            => new sfWidgetFormInputText(),
      'first_name'        => new sfWidgetFormInputText(),
      'middle_name'       => new sfWidgetFormInputText(),
      'last_name'         => new sfWidgetFormInputText(),
      'dob'               => new sfWidgetFormDate(),
      'gender'            => new sfWidgetFormChoice(array('choices' => array('M' => 'M', 'F' => 'F', 'O' => 'O'))),
      'pan_no'            => new sfWidgetFormInputText(),
      'email_address'     => new sfWidgetFormInputText(),
      'phone_no'          => new sfWidgetFormInputText(),
      'fathers_name'      => new sfWidgetFormInputText(),
      'mothers_name'      => new sfWidgetFormInputText(),
      'flat_no'           => new sfWidgetFormInputText(),
      'premises'          => new sfWidgetFormInputText(),
      'street'            => new sfWidgetFormInputText(),
      'area'              => new sfWidgetFormInputText(),
      'city'              => new sfWidgetFormInputText(),
      'state'             => new sfWidgetFormInputText(),
      'country'           => new sfWidgetFormInputText(),
      'pin'               => new sfWidgetFormInputText(),
      'bank_ac_no'        => new sfWidgetFormInputText(),
      'ac_type'           => new sfWidgetFormInputText(),
      'ifsc_code'         => new sfWidgetFormInputText(),
      'micr_code'         => new sfWidgetFormInputText(),
      'notes'             => new sfWidgetFormTextarea(),
      'tax_due'           => new sfWidgetFormInputText(),
      'due_date'          => new sfWidgetFormDate(),
      'payment_confirmed' => new sfWidgetFormInputCheckbox(),
      'payment_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('payment'), 'add_empty' => true)),
      'ack_file'          => new sfWidgetFormInputText(),
      'created_at'        => new sfWidgetFormDateTime(),
      'updated_at'        => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'member_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('member'), 'required' => false)),
      'product_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('product'), 'required' => false)),
      'status'            => new sfValidatorInteger(array('required' => false)),
      'first_name'        => new sfValidatorString(array('max_length' => 40, 'required' => false)),
      'middle_name'       => new sfValidatorString(array('max_length' => 40, 'required' => false)),
      'last_name'         => new sfValidatorString(array('max_length' => 40, 'required' => false)),
      'dob'               => new sfValidatorDate(array('required' => false)),
      'gender'            => new sfValidatorChoice(array('choices' => array(0 => 'M', 1 => 'F', 2 => 'O'), 'required' => false)),
      'pan_no'            => new sfValidatorString(array('max_length' => 12, 'required' => false)),
      'email_address'     => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'phone_no'          => new sfValidatorString(array('max_length' => 40, 'required' => false)),
      'fathers_name'      => new sfValidatorString(array('max_length' => 120, 'required' => false)),
      'mothers_name'      => new sfValidatorString(array('max_length' => 120, 'required' => false)),
      'flat_no'           => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'premises'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'street'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'area'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'city'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'state'             => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'country'           => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'pin'               => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'bank_ac_no'        => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'ac_type'           => new sfValidatorInteger(array('required' => false)),
      'ifsc_code'         => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'micr_code'         => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'notes'             => new sfValidatorString(array('max_length' => 500, 'required' => false)),
      'tax_due'           => new sfValidatorNumber(array('required' => false)),
      'due_date'          => new sfValidatorDate(array('required' => false)),
      'payment_confirmed' => new sfValidatorBoolean(array('required' => false)),
      'payment_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('payment'), 'required' => false)),
      'ack_file'          => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'created_at'        => new sfValidatorDateTime(),
      'updated_at'        => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('itr_submission[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'itr_submission';
  }

}
