<?php

/**
 * coupon form base class.
 *
 * @method coupon getObject() Returns the current form's model object
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasecouponForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'title'            => new sfWidgetFormInputText(),
      'coupon_type'      => new sfWidgetFormInputText(),
      'discount_type'    => new sfWidgetFormInputText(),
      'discount_rate'    => new sfWidgetFormInputText(),
      'limit_per_member' => new sfWidgetFormInputText(),
      'quantity'         => new sfWidgetFormInputText(),
      'active'           => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'title'            => new sfValidatorString(array('max_length' => 255)),
      'coupon_type'      => new sfValidatorInteger(array('required' => false)),
      'discount_type'    => new sfValidatorInteger(),
      'discount_rate'    => new sfValidatorNumber(array('required' => false)),
      'limit_per_member' => new sfValidatorInteger(array('required' => false)),
      'quantity'         => new sfValidatorInteger(array('required' => false)),
      'active'           => new sfValidatorBoolean(),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'coupon', 'column' => array('title')))
    );

    $this->widgetSchema->setNameFormat('coupon[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'coupon';
  }

}
