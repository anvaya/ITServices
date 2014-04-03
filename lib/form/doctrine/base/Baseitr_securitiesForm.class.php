<?php

/**
 * itr_securities form base class.
 *
 * @method itr_securities getObject() Returns the current form's model object
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class Baseitr_securitiesForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'submission_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('itr_submission'), 'add_empty' => true)),
      'category_id'      => new sfWidgetFormInputText(),
      'details'          => new sfWidgetFormInputText(),
      'purchase_info'    => new sfWidgetFormTextarea(),
      'date_sale'        => new sfWidgetFormDate(),
      'quantity_sold'    => new sfWidgetFormInputText(),
      'cost_acquisition' => new sfWidgetFormInputText(),
      'sell_value'       => new sfWidgetFormInputText(),
      'brokerage_paid'   => new sfWidgetFormInputText(),
      'other_expenses'   => new sfWidgetFormInputText(),
      'addon_costs'      => new sfWidgetFormTextarea(),
      'addon_expenses'   => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'submission_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('itr_submission'), 'required' => false)),
      'category_id'      => new sfValidatorInteger(array('required' => false)),
      'details'          => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'purchase_info'    => new sfValidatorString(array('max_length' => 600, 'required' => false)),
      'date_sale'        => new sfValidatorDate(array('required' => false)),
      'quantity_sold'    => new sfValidatorInteger(array('required' => false)),
      'cost_acquisition' => new sfValidatorNumber(array('required' => false)),
      'sell_value'       => new sfValidatorNumber(array('required' => false)),
      'brokerage_paid'   => new sfValidatorNumber(array('required' => false)),
      'other_expenses'   => new sfValidatorNumber(array('required' => false)),
      'addon_costs'      => new sfValidatorString(array('max_length' => 600, 'required' => false)),
      'addon_expenses'   => new sfValidatorString(array('max_length' => 600, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('itr_securities[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'itr_securities';
  }

}
