<?php

/**
 * itr_exemption filter form base class.
 *
 * @package    BestBuddies
 * @subpackage filter
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class Baseitr_exemptionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'submission_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('itr_submission'), 'add_empty' => true)),
      'category_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('exemption_category'), 'add_empty' => true)),
      'amount'        => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'submission_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('itr_submission'), 'column' => 'id')),
      'category_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('exemption_category'), 'column' => 'id')),
      'amount'        => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('itr_exemption_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'itr_exemption';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'submission_id' => 'ForeignKey',
      'category_id'   => 'ForeignKey',
      'amount'        => 'Number',
    );
  }
}
