<?php

/**
 * newsnevent filter form base class.
 *
 * @package    BestBuddies
 * @subpackage filter
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasenewsneventFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'is_event'     => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'event_date'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'picture_file' => new sfWidgetFormFilterInput(),
      'title'        => new sfWidgetFormFilterInput(),
      'subtitle'     => new sfWidgetFormFilterInput(),
      'event_body'   => new sfWidgetFormFilterInput(),
      'disabled'     => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'is_event'     => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'event_date'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'picture_file' => new sfValidatorPass(array('required' => false)),
      'title'        => new sfValidatorPass(array('required' => false)),
      'subtitle'     => new sfValidatorPass(array('required' => false)),
      'event_body'   => new sfValidatorPass(array('required' => false)),
      'disabled'     => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('newsnevent_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'newsnevent';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'is_event'     => 'Boolean',
      'event_date'   => 'Date',
      'picture_file' => 'Text',
      'title'        => 'Text',
      'subtitle'     => 'Text',
      'event_body'   => 'Text',
      'disabled'     => 'Boolean',
    );
  }
}
