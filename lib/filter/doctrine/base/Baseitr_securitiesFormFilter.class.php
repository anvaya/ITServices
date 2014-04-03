<?php

/**
 * itr_securities filter form base class.
 *
 * @package    BestBuddies
 * @subpackage filter
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class Baseitr_securitiesFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'submission_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('itr_submission'), 'add_empty' => true)),
      'category_id'      => new sfWidgetFormFilterInput(),
      'details'          => new sfWidgetFormFilterInput(),
      'purchase_info'    => new sfWidgetFormFilterInput(),
      'date_sale'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'quantity_sold'    => new sfWidgetFormFilterInput(),
      'cost_acquisition' => new sfWidgetFormFilterInput(),
      'sell_value'       => new sfWidgetFormFilterInput(),
      'brokerage_paid'   => new sfWidgetFormFilterInput(),
      'other_expenses'   => new sfWidgetFormFilterInput(),
      'addon_costs'      => new sfWidgetFormFilterInput(),
      'addon_expenses'   => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'submission_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('itr_submission'), 'column' => 'id')),
      'category_id'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'details'          => new sfValidatorPass(array('required' => false)),
      'purchase_info'    => new sfValidatorPass(array('required' => false)),
      'date_sale'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'quantity_sold'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'cost_acquisition' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'sell_value'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'brokerage_paid'   => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'other_expenses'   => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'addon_costs'      => new sfValidatorPass(array('required' => false)),
      'addon_expenses'   => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('itr_securities_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'itr_securities';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'submission_id'    => 'ForeignKey',
      'category_id'      => 'Number',
      'details'          => 'Text',
      'purchase_info'    => 'Text',
      'date_sale'        => 'Date',
      'quantity_sold'    => 'Number',
      'cost_acquisition' => 'Number',
      'sell_value'       => 'Number',
      'brokerage_paid'   => 'Number',
      'other_expenses'   => 'Number',
      'addon_costs'      => 'Text',
      'addon_expenses'   => 'Text',
    );
  }
}
