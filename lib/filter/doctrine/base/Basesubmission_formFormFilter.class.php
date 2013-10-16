<?php

/**
 * submission_form filter form base class.
 *
 * @package    BestBuddies
 * @subpackage filter
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class Basesubmission_formFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'form_code'        => new sfWidgetFormFilterInput(),
      'form_name'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'disabled'         => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'frequency'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'send_reminder'    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'form_description' => new sfWidgetFormFilterInput(),
      'template_name'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'form_code'        => new sfValidatorPass(array('required' => false)),
      'form_name'        => new sfValidatorPass(array('required' => false)),
      'disabled'         => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'frequency'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'send_reminder'    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'form_description' => new sfValidatorPass(array('required' => false)),
      'template_name'    => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('submission_form_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'submission_form';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'form_code'        => 'Text',
      'form_name'        => 'Text',
      'disabled'         => 'Boolean',
      'frequency'        => 'Number',
      'send_reminder'    => 'Boolean',
      'form_description' => 'Text',
      'template_name'    => 'Text',
    );
  }
}
