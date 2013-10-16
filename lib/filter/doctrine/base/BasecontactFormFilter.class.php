<?php

/**
 * contact filter form base class.
 *
 * @package    BestBuddies
 * @subpackage filter
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasecontactFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'contact_type' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'member_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('member'), 'add_empty' => true)),
      'country'      => new sfWidgetFormFilterInput(),
      'isd_code'     => new sfWidgetFormFilterInput(),
      'std_code'     => new sfWidgetFormFilterInput(),
      'contact_text' => new sfWidgetFormFilterInput(),
      'first_name'   => new sfWidgetFormFilterInput(),
      'last_name'    => new sfWidgetFormFilterInput(),
      'dob'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'relation'     => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'contact_type' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'member_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('member'), 'column' => 'id')),
      'country'      => new sfValidatorPass(array('required' => false)),
      'isd_code'     => new sfValidatorPass(array('required' => false)),
      'std_code'     => new sfValidatorPass(array('required' => false)),
      'contact_text' => new sfValidatorPass(array('required' => false)),
      'first_name'   => new sfValidatorPass(array('required' => false)),
      'last_name'    => new sfValidatorPass(array('required' => false)),
      'dob'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'relation'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('contact_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'contact';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'contact_type' => 'Number',
      'member_id'    => 'ForeignKey',
      'country'      => 'Text',
      'isd_code'     => 'Text',
      'std_code'     => 'Text',
      'contact_text' => 'Text',
      'first_name'   => 'Text',
      'last_name'    => 'Text',
      'dob'          => 'Date',
      'relation'     => 'Number',
    );
  }
}
