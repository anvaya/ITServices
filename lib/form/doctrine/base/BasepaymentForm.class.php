<?php

/**
 * payment form base class.
 *
 * @method payment getObject() Returns the current form's model object
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasepaymentForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'member_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('member'), 'add_empty' => false)),
      'submission_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('submission'), 'add_empty' => true)),
      'subscription_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('member_subscription'), 'add_empty' => true)),
      'payment_type'    => new sfWidgetFormInputText(),
      'payment_date'    => new sfWidgetFormDate(),
      'bank_name'       => new sfWidgetFormInputText(),
      'branch'          => new sfWidgetFormInputText(),
      'payment_ref_no'  => new sfWidgetFormInputText(),
      'transaction_id'  => new sfWidgetFormInputText(),
      'amount'          => new sfWidgetFormInputText(),
      'routed_through'  => new sfWidgetFormInputText(),
      'status'          => new sfWidgetFormInputText(),
      'ip_address'      => new sfWidgetFormInputText(),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'member_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('member'))),
      'submission_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('submission'), 'required' => false)),
      'subscription_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('member_subscription'), 'required' => false)),
      'payment_type'    => new sfValidatorInteger(array('required' => false)),
      'payment_date'    => new sfValidatorDate(array('required' => false)),
      'bank_name'       => new sfValidatorPass(array('required' => false)),
      'branch'          => new sfValidatorPass(array('required' => false)),
      'payment_ref_no'  => new sfValidatorPass(array('required' => false)),
      'transaction_id'  => new sfValidatorPass(array('required' => false)),
      'amount'          => new sfValidatorNumber(array('required' => false)),
      'routed_through'  => new sfValidatorPass(array('required' => false)),
      'status'          => new sfValidatorInteger(array('required' => false)),
      'ip_address'      => new sfValidatorInteger(array('required' => false)),
      'created_at'      => new sfValidatorDateTime(),
      'updated_at'      => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('payment[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'payment';
  }

}
