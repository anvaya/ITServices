<?php

/**
 * itr_property form base class.
 *
 * @method itr_property getObject() Returns the current form's model object
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class Baseitr_propertyForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'submission_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('itr_submission'), 'add_empty' => true)),
      'address'           => new sfWidgetFormTextarea(),
      'locality'          => new sfWidgetFormInputText(),
      'city'              => new sfWidgetFormInputText(),
      'state'             => new sfWidgetFormInputText(),
      'pin'               => new sfWidgetFormInputText(),
      'co_owned'          => new sfWidgetFormInputCheckbox(),
      'percent_share'     => new sfWidgetFormInputText(),
      'owners'            => new sfWidgetFormTextarea(),
      'let_out'           => new sfWidgetFormInputCheckbox(),
      'tenant'            => new sfWidgetFormInputText(),
      'tenant_pan'        => new sfWidgetFormInputText(),
      'rent_not_realized' => new sfWidgetFormInputText(),
      'tax_paid'          => new sfWidgetFormInputText(),
      'loan_taken'        => new sfWidgetFormInputCheckbox(),
      'property_cost'     => new sfWidgetFormInputText(),
      'loan_amount'       => new sfWidgetFormInputText(),
      'loan_repaid'       => new sfWidgetFormInputText(),
      'interest_paid'     => new sfWidgetFormInputText(),
      'loan_oustanding'   => new sfWidgetFormInputText(),
      'prev_year_receipt' => new sfWidgetFormTextarea(),
      'rent_rcvd'         => new sfWidgetFormInputText(),
      'rent_details'      => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'submission_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('itr_submission'), 'required' => false)),
      'address'           => new sfValidatorString(array('max_length' => 500, 'required' => false)),
      'locality'          => new sfValidatorString(array('max_length' => 150, 'required' => false)),
      'city'              => new sfValidatorString(array('max_length' => 70, 'required' => false)),
      'state'             => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'pin'               => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'co_owned'          => new sfValidatorBoolean(array('required' => false)),
      'percent_share'     => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'owners'            => new sfValidatorString(array('max_length' => 600, 'required' => false)),
      'let_out'           => new sfValidatorBoolean(array('required' => false)),
      'tenant'            => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'tenant_pan'        => new sfValidatorString(array('max_length' => 12, 'required' => false)),
      'rent_not_realized' => new sfValidatorNumber(array('required' => false)),
      'tax_paid'          => new sfValidatorNumber(array('required' => false)),
      'loan_taken'        => new sfValidatorBoolean(array('required' => false)),
      'property_cost'     => new sfValidatorNumber(array('required' => false)),
      'loan_amount'       => new sfValidatorNumber(array('required' => false)),
      'loan_repaid'       => new sfValidatorNumber(array('required' => false)),
      'interest_paid'     => new sfValidatorNumber(array('required' => false)),
      'loan_oustanding'   => new sfValidatorNumber(array('required' => false)),
      'prev_year_receipt' => new sfValidatorString(array('max_length' => 600, 'required' => false)),
      'rent_rcvd'         => new sfValidatorNumber(array('required' => false)),
      'rent_details'      => new sfValidatorString(array('max_length' => 600, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('itr_property[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'itr_property';
  }

}
