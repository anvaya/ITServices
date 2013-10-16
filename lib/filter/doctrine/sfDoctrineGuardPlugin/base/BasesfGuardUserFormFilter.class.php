<?php

/**
 * sfGuardUser filter form base class.
 *
 * @package    BestBuddies
 * @subpackage filter
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasesfGuardUserFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'first_name'           => new sfWidgetFormFilterInput(),
      'last_name'            => new sfWidgetFormFilterInput(),
      'email_address'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'username'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'algorithm'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'salt'                 => new sfWidgetFormFilterInput(),
      'password'             => new sfWidgetFormFilterInput(),
      'is_active'            => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_super_admin'       => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'last_login'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'is_member'            => new sfWidgetFormFilterInput(),
      'member_type_id'       => new sfWidgetFormFilterInput(),
      'country'              => new sfWidgetFormFilterInput(),
      'timezone'             => new sfWidgetFormFilterInput(),
      'culture'              => new sfWidgetFormFilterInput(),
      'middle_name'          => new sfWidgetFormFilterInput(),
      'dob'                  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'passport_no'          => new sfWidgetFormFilterInput(),
      'pan_no'               => new sfWidgetFormFilterInput(),
      'occupation_type'      => new sfWidgetFormFilterInput(),
      'job_title'            => new sfWidgetFormFilterInput(),
      'industry'             => new sfWidgetFormFilterInput(),
      'other_income_source'  => new sfWidgetFormFilterInput(),
      'married'              => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'gender'               => new sfWidgetFormChoice(array('choices' => array('' => '', 'M' => 'M', 'F' => 'F'))),
      'marriage_anniversary' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'year_as_nri'          => new sfWidgetFormFilterInput(),
      'created_at'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'           => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'groups_list'          => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardGroup')),
      'permissions_list'     => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardPermission')),
    ));

    $this->setValidators(array(
      'first_name'           => new sfValidatorPass(array('required' => false)),
      'last_name'            => new sfValidatorPass(array('required' => false)),
      'email_address'        => new sfValidatorPass(array('required' => false)),
      'username'             => new sfValidatorPass(array('required' => false)),
      'algorithm'            => new sfValidatorPass(array('required' => false)),
      'salt'                 => new sfValidatorPass(array('required' => false)),
      'password'             => new sfValidatorPass(array('required' => false)),
      'is_active'            => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_super_admin'       => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'last_login'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'is_member'            => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'member_type_id'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'country'              => new sfValidatorPass(array('required' => false)),
      'timezone'             => new sfValidatorPass(array('required' => false)),
      'culture'              => new sfValidatorPass(array('required' => false)),
      'middle_name'          => new sfValidatorPass(array('required' => false)),
      'dob'                  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'passport_no'          => new sfValidatorPass(array('required' => false)),
      'pan_no'               => new sfValidatorPass(array('required' => false)),
      'occupation_type'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'job_title'            => new sfValidatorPass(array('required' => false)),
      'industry'             => new sfValidatorPass(array('required' => false)),
      'other_income_source'  => new sfValidatorPass(array('required' => false)),
      'married'              => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'gender'               => new sfValidatorChoice(array('required' => false, 'choices' => array('M' => 'M', 'F' => 'F'))),
      'marriage_anniversary' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'year_as_nri'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'           => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'groups_list'          => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardGroup', 'required' => false)),
      'permissions_list'     => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardPermission', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sf_guard_user_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addGroupsListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query
      ->leftJoin($query->getRootAlias().'.sfGuardUserGroup sfGuardUserGroup')
      ->andWhereIn('sfGuardUserGroup.group_id', $values)
    ;
  }

  public function addPermissionsListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query
      ->leftJoin($query->getRootAlias().'.sfGuardUserPermission sfGuardUserPermission')
      ->andWhereIn('sfGuardUserPermission.permission_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'sfGuardUser';
  }

  public function getFields()
  {
    return array(
      'id'                   => 'Number',
      'first_name'           => 'Text',
      'last_name'            => 'Text',
      'email_address'        => 'Text',
      'username'             => 'Text',
      'algorithm'            => 'Text',
      'salt'                 => 'Text',
      'password'             => 'Text',
      'is_active'            => 'Boolean',
      'is_super_admin'       => 'Boolean',
      'last_login'           => 'Date',
      'is_member'            => 'Number',
      'member_type_id'       => 'Number',
      'country'              => 'Text',
      'timezone'             => 'Text',
      'culture'              => 'Text',
      'middle_name'          => 'Text',
      'dob'                  => 'Date',
      'passport_no'          => 'Text',
      'pan_no'               => 'Text',
      'occupation_type'      => 'Number',
      'job_title'            => 'Text',
      'industry'             => 'Text',
      'other_income_source'  => 'Text',
      'married'              => 'Boolean',
      'gender'               => 'Enum',
      'marriage_anniversary' => 'Date',
      'year_as_nri'          => 'Number',
      'created_at'           => 'Date',
      'updated_at'           => 'Date',
      'groups_list'          => 'ManyKey',
      'permissions_list'     => 'ManyKey',
    );
  }
}
