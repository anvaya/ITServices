<?php

/**
 * itr_property filter form base class.
 *
 * @package    BestBuddies
 * @subpackage filter
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class Baseitr_propertyFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'submission_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('itr_submission'), 'add_empty' => true)),
      'address'           => new sfWidgetFormFilterInput(),
      'locality'          => new sfWidgetFormFilterInput(),
      'city'              => new sfWidgetFormFilterInput(),
      'state'             => new sfWidgetFormFilterInput(),
      'pin'               => new sfWidgetFormFilterInput(),
      'co_owned'          => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'percent_share'     => new sfWidgetFormFilterInput(),
      'owners'            => new sfWidgetFormFilterInput(),
      'let_out'           => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'tenant'            => new sfWidgetFormFilterInput(),
      'tenant_pan'        => new sfWidgetFormFilterInput(),
      'rent_not_realized' => new sfWidgetFormFilterInput(),
      'tax_paid'          => new sfWidgetFormFilterInput(),
      'loan_taken'        => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'property_cost'     => new sfWidgetFormFilterInput(),
      'loan_amount'       => new sfWidgetFormFilterInput(),
      'loan_repaid'       => new sfWidgetFormFilterInput(),
      'interest_paid'     => new sfWidgetFormFilterInput(),
      'loan_oustanding'   => new sfWidgetFormFilterInput(),
      'prev_year_receipt' => new sfWidgetFormFilterInput(),
      'rent_rcvd'         => new sfWidgetFormFilterInput(),
      'rent_details'      => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'submission_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('itr_submission'), 'column' => 'id')),
      'address'           => new sfValidatorPass(array('required' => false)),
      'locality'          => new sfValidatorPass(array('required' => false)),
      'city'              => new sfValidatorPass(array('required' => false)),
      'state'             => new sfValidatorPass(array('required' => false)),
      'pin'               => new sfValidatorPass(array('required' => false)),
      'co_owned'          => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'percent_share'     => new sfValidatorPass(array('required' => false)),
      'owners'            => new sfValidatorPass(array('required' => false)),
      'let_out'           => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'tenant'            => new sfValidatorPass(array('required' => false)),
      'tenant_pan'        => new sfValidatorPass(array('required' => false)),
      'rent_not_realized' => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'tax_paid'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'loan_taken'        => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'property_cost'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'loan_amount'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'loan_repaid'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'interest_paid'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'loan_oustanding'   => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'prev_year_receipt' => new sfValidatorPass(array('required' => false)),
      'rent_rcvd'         => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'rent_details'      => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('itr_property_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'itr_property';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'submission_id'     => 'ForeignKey',
      'address'           => 'Text',
      'locality'          => 'Text',
      'city'              => 'Text',
      'state'             => 'Text',
      'pin'               => 'Text',
      'co_owned'          => 'Boolean',
      'percent_share'     => 'Text',
      'owners'            => 'Text',
      'let_out'           => 'Boolean',
      'tenant'            => 'Text',
      'tenant_pan'        => 'Text',
      'rent_not_realized' => 'Number',
      'tax_paid'          => 'Number',
      'loan_taken'        => 'Boolean',
      'property_cost'     => 'Number',
      'loan_amount'       => 'Number',
      'loan_repaid'       => 'Number',
      'interest_paid'     => 'Number',
      'loan_oustanding'   => 'Number',
      'prev_year_receipt' => 'Text',
      'rent_rcvd'         => 'Number',
      'rent_details'      => 'Text',
    );
  }
}
