<?php

/**
 * product_usage form base class.
 *
 * @method product_usage getObject() Returns the current form's model object
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class Baseproduct_usageForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                     => new sfWidgetFormInputHidden(),
      'member_subscription_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('member_subscription'), 'add_empty' => false)),
      'product_id'             => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('product'), 'add_empty' => true)),
      'from_time'              => new sfWidgetFormDateTime(),
      'to_time'                => new sfWidgetFormDateTime(),
      'units'                  => new sfWidgetFormInputText(),
      'ip_address'             => new sfWidgetFormInputText(),
      'created_at'             => new sfWidgetFormDateTime(),
      'updated_at'             => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                     => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'member_subscription_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('member_subscription'))),
      'product_id'             => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('product'), 'required' => false)),
      'from_time'              => new sfValidatorDateTime(array('required' => false)),
      'to_time'                => new sfValidatorDateTime(array('required' => false)),
      'units'                  => new sfValidatorInteger(array('required' => false)),
      'ip_address'             => new sfValidatorInteger(array('required' => false)),
      'created_at'             => new sfValidatorDateTime(),
      'updated_at'             => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('product_usage[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'product_usage';
  }

}
