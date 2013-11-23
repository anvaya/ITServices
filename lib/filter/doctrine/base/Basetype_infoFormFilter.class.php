<?php

/**
 * type_info filter form base class.
 *
 * @package    BestBuddies
 * @subpackage filter
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class Basetype_infoFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'type_id'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'type_name' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'disabled'  => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'type_id'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'type_name' => new sfValidatorPass(array('required' => false)),
      'disabled'  => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('type_info_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'type_info';
  }

  public function getFields()
  {
    return array(
      'id'        => 'Number',
      'type_id'   => 'Number',
      'type_name' => 'Text',
      'disabled'  => 'Boolean',
    );
  }
}
