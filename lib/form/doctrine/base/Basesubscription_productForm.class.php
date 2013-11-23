<?php

/**
 * subscription_product form base class.
 *
 * @method subscription_product getObject() Returns the current form's model object
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class Basesubscription_productForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'subscription_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('subscription'), 'add_empty' => false)),
      'product_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('product'), 'add_empty' => false)),
      'units'           => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'subscription_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('subscription'))),
      'product_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('product'))),
      'units'           => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('subscription_product[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'subscription_product';
  }

}
