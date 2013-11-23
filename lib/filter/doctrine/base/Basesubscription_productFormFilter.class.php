<?php

/**
 * subscription_product filter form base class.
 *
 * @package    BestBuddies
 * @subpackage filter
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class Basesubscription_productFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'subscription_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('subscription'), 'add_empty' => true)),
      'product_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('product'), 'add_empty' => true)),
      'units'           => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'subscription_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('subscription'), 'column' => 'id')),
      'product_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('product'), 'column' => 'id')),
      'units'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('subscription_product_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'subscription_product';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'subscription_id' => 'ForeignKey',
      'product_id'      => 'ForeignKey',
      'units'           => 'Number',
    );
  }
}
