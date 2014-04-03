<?php

/**
 * faq filter form base class.
 *
 * @package    BestBuddies
 * @subpackage filter
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasefaqFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'question' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'answer'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ordering' => new sfWidgetFormFilterInput(),
      'active'   => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'slug'     => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'question' => new sfValidatorPass(array('required' => false)),
      'answer'   => new sfValidatorPass(array('required' => false)),
      'ordering' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'active'   => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'slug'     => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('faq_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'faq';
  }

  public function getFields()
  {
    return array(
      'id'       => 'Number',
      'question' => 'Text',
      'answer'   => 'Text',
      'ordering' => 'Number',
      'active'   => 'Boolean',
      'slug'     => 'Text',
    );
  }
}
