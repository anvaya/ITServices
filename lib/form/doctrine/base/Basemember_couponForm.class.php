<?php

/**
 * member_coupon form base class.
 *
 * @method member_coupon getObject() Returns the current form's model object
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class Basemember_couponForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'coupon_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('coupon'), 'add_empty' => true)),
      'member_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('member'), 'add_empty' => true)),
      'coupon_code' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('order'), 'add_empty' => false)),
      'approved'    => new sfWidgetFormInputCheckbox(),
      'used'        => new sfWidgetFormInputCheckbox(),
      'product_id'  => new sfWidgetFormInputText(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'coupon_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('coupon'), 'required' => false)),
      'member_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('member'), 'required' => false)),
      'coupon_code' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('order'))),
      'approved'    => new sfValidatorBoolean(array('required' => false)),
      'used'        => new sfValidatorBoolean(array('required' => false)),
      'product_id'  => new sfValidatorInteger(array('required' => false)),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'member_coupon', 'column' => array('coupon_code')))
    );

    $this->widgetSchema->setNameFormat('member_coupon[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'member_coupon';
  }

}
