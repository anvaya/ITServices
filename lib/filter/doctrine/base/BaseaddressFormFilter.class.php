<?php

/**
 * address filter form base class.
 *
 * @package    BestBuddies
 * @subpackage filter
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseaddressFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'address_type' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'member_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('member'), 'add_empty' => true)),
      'flat_no'      => new sfWidgetFormFilterInput(),
      'premises'     => new sfWidgetFormFilterInput(),
      'street'       => new sfWidgetFormFilterInput(),
      'area'         => new sfWidgetFormFilterInput(),
      'city'         => new sfWidgetFormFilterInput(),
      'state'        => new sfWidgetFormFilterInput(),
      'country'      => new sfWidgetFormFilterInput(),
      'pin'          => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'address_type' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'member_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('member'), 'column' => 'id')),
      'flat_no'      => new sfValidatorPass(array('required' => false)),
      'premises'     => new sfValidatorPass(array('required' => false)),
      'street'       => new sfValidatorPass(array('required' => false)),
      'area'         => new sfValidatorPass(array('required' => false)),
      'city'         => new sfValidatorPass(array('required' => false)),
      'state'        => new sfValidatorPass(array('required' => false)),
      'country'      => new sfValidatorPass(array('required' => false)),
      'pin'          => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('address_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'address';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'address_type' => 'Number',
      'member_id'    => 'ForeignKey',
      'flat_no'      => 'Text',
      'premises'     => 'Text',
      'street'       => 'Text',
      'area'         => 'Text',
      'city'         => 'Text',
      'state'        => 'Text',
      'country'      => 'Text',
      'pin'          => 'Text',
    );
  }
}
