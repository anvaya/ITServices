<?php

/**
 * coupon filter form base class.
 *
 * @package    BestBuddies
 * @subpackage filter
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasecouponFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'title'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'coupon_type'      => new sfWidgetFormFilterInput(),
      'discount_type'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'discount_rate'    => new sfWidgetFormFilterInput(),
      'limit_per_member' => new sfWidgetFormFilterInput(),
      'quantity'         => new sfWidgetFormFilterInput(),
      'active'           => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'title'            => new sfValidatorPass(array('required' => false)),
      'coupon_type'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'discount_type'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'discount_rate'    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'limit_per_member' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'quantity'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'active'           => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('coupon_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'coupon';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'title'            => 'Text',
      'coupon_type'      => 'Number',
      'discount_type'    => 'Number',
      'discount_rate'    => 'Number',
      'limit_per_member' => 'Number',
      'quantity'         => 'Number',
      'active'           => 'Boolean',
    );
  }
}
