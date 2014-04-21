<?php

/**
 * order form base class.
 *
 * @method order getObject() Returns the current form's model object
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseorderForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'member_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('member'), 'add_empty' => true)),
      'order_no'            => new sfWidgetFormInputText(),
      'order_date'          => new sfWidgetFormDate(),
      'status'              => new sfWidgetFormInputText(),
      'gross_amount'        => new sfWidgetFormInputText(),
      'discount_amount'     => new sfWidgetFormInputText(),
      'discount_voucher_no' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('member_coupon'), 'add_empty' => true)),
      'discount_percentage' => new sfWidgetFormInputText(),
      'tax_amount'          => new sfWidgetFormInputText(),
      'net_amount'          => new sfWidgetFormInputText(),
      'payment_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('payment'), 'add_empty' => true)),
      'created_at'          => new sfWidgetFormDateTime(),
      'updated_at'          => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'member_id'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('member'), 'required' => false)),
      'order_no'            => new sfValidatorPass(array('required' => false)),
      'order_date'          => new sfValidatorDate(array('required' => false)),
      'status'              => new sfValidatorInteger(array('required' => false)),
      'gross_amount'        => new sfValidatorNumber(array('required' => false)),
      'discount_amount'     => new sfValidatorNumber(array('required' => false)),
      'discount_voucher_no' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('member_coupon'), 'required' => false)),
      'discount_percentage' => new sfValidatorInteger(array('required' => false)),
      'tax_amount'          => new sfValidatorNumber(array('required' => false)),
      'net_amount'          => new sfValidatorNumber(array('required' => false)),
      'payment_id'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('payment'), 'required' => false)),
      'created_at'          => new sfValidatorDateTime(),
      'updated_at'          => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorAnd(array(
        new sfValidatorDoctrineUnique(array('model' => 'order', 'column' => array('order_no'))),
        new sfValidatorDoctrineUnique(array('model' => 'order', 'column' => array('discount_voucher_no'))),
      ))
    );

    $this->widgetSchema->setNameFormat('order[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'order';
  }

}
