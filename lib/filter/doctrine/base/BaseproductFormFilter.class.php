<?php

/**
 * product filter form base class.
 *
 * @package    BestBuddies
 * @subpackage filter
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseproductFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'code'            => new sfWidgetFormFilterInput(),
      'name'            => new sfWidgetFormFilterInput(),
      'description'     => new sfWidgetFormFilterInput(),
      'category_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('product_category'), 'add_empty' => true)),
      'expiry_date'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'expired'         => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'billing_unit_id' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'form_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('submission_form'), 'add_empty' => true)),
      'price'           => new sfWidgetFormFilterInput(),
      'template'        => new sfWidgetFormFilterInput(),
      'fy'              => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'code'            => new sfValidatorPass(array('required' => false)),
      'name'            => new sfValidatorPass(array('required' => false)),
      'description'     => new sfValidatorPass(array('required' => false)),
      'category_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('product_category'), 'column' => 'id')),
      'expiry_date'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'expired'         => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'billing_unit_id' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'form_id'         => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('submission_form'), 'column' => 'id')),
      'price'           => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'template'        => new sfValidatorPass(array('required' => false)),
      'fy'              => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('product_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'product';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'code'            => 'Text',
      'name'            => 'Text',
      'description'     => 'Text',
      'category_id'     => 'ForeignKey',
      'expiry_date'     => 'Date',
      'expired'         => 'Boolean',
      'billing_unit_id' => 'Number',
      'form_id'         => 'ForeignKey',
      'price'           => 'Number',
      'template'        => 'Text',
      'fy'              => 'Number',
    );
  }
}
