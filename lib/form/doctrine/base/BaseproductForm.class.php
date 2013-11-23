<?php

/**
 * product form base class.
 *
 * @method product getObject() Returns the current form's model object
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseproductForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'code'         => new sfWidgetFormInputText(),
      'name'         => new sfWidgetFormInputText(),
      'description'  => new sfWidgetFormTextarea(),
      'category_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('product_category'), 'add_empty' => true)),
      'expiry_date'  => new sfWidgetFormDate(),
      'expired'      => new sfWidgetFormInputCheckbox(),
      'billing_unit' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('billing_unit'), 'add_empty' => false)),
      'form_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('submission_form'), 'add_empty' => true)),
      'price'        => new sfWidgetFormInputText(),
      'template'     => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'code'         => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'name'         => new sfValidatorString(array('max_length' => 200, 'required' => false)),
      'description'  => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'category_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('product_category'), 'required' => false)),
      'expiry_date'  => new sfValidatorDate(array('required' => false)),
      'expired'      => new sfValidatorBoolean(array('required' => false)),
      'billing_unit' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('billing_unit'))),
      'form_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('submission_form'), 'required' => false)),
      'price'        => new sfValidatorNumber(array('required' => false)),
      'template'     => new sfValidatorString(array('max_length' => 60, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('product[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'product';
  }

}
