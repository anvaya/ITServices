<?php

/**
 * itr_file filter form base class.
 *
 * @package    BestBuddies
 * @subpackage filter
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class Baseitr_fileFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'submission_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('itr_submission'), 'add_empty' => true)),
      'category_id'   => new sfWidgetFormFilterInput(),
      'filename'      => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'submission_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('itr_submission'), 'column' => 'id')),
      'category_id'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'filename'      => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('itr_file_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'itr_file';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'submission_id' => 'ForeignKey',
      'category_id'   => 'Number',
      'filename'      => 'Text',
    );
  }
}
