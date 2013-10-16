<?php

/**
 * profile module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage profile
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: configuration.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseProfileGeneratorConfiguration extends sfModelGeneratorConfiguration
{
  public function getActionsDefault()
  {
    return array();
  }

  public function getFormActions()
  {
    return array(  '_delete' => NULL,  '_list' => NULL,  '_save' => NULL,  '_save_and_add' => NULL,);
  }

  public function getNewActions()
  {
    return array();
  }

  public function getEditActions()
  {
    return array(  '_save' => NULL,);
  }

  public function getListObjectActions()
  {
    return array(  '_edit' => NULL,  '_delete' => NULL,);
  }

  public function getListActions()
  {
    return array(  '_new' => NULL,);
  }

  public function getListBatchActions()
  {
    return array(  '_delete' => NULL,);
  }

  public function getListParams()
  {
    return '%%id%% - %%first_name%% - %%last_name%% - %%email_address%% - %%username%% - %%algorithm%% - %%salt%% - %%password%% - %%is_active%% - %%is_super_admin%% - %%last_login%% - %%is_member%% - %%member_type_id%% - %%country%% - %%timezone%% - %%culture%% - %%middle_name%% - %%dob%% - %%passport_no%% - %%pan_no%% - %%occupation_type%% - %%job_title%% - %%industry%% - %%other_income_source%% - %%married%% - %%gender%% - %%marriage_anniversary%% - %%year_as_nri%% - %%created_at%% - %%updated_at%%';
  }

  public function getListLayout()
  {
    return 'tabular';
  }

  public function getListTitle()
  {
    return 'Profile List';
  }

  public function getEditTitle()
  {
    return 'My Profile';
  }

  public function getNewTitle()
  {
    return 'New Profile';
  }

  public function getFilterDisplay()
  {
    return array();
  }

  public function getFormDisplay()
  {
    return array();
  }

  public function getEditDisplay()
  {
    return array(  'Personal Details' =>   array(    0 => 'first_name',    1 => 'middle_name',    2 => 'last_name',    3 => 'dob',    4 => 'email_address',    5 => 'country',    6 => 'year_as_nri',    7 => 'married',    8 => 'marriage_anniversary',  ),  'Current Address' =>   array(    0 => 'nri_address',  ),  'Address In India' =>   array(    0 => 'in_address',  ),  'Contact Information' =>   array(    0 => 'nri_mobile',    1 => 'nri_landline',    2 => 'nri_office',    3 => 'nri_fax',  ),  'Contact Information (India)' =>   array(    0 => 'in_mobile',    1 => 'in_landline',  ),  'Occupation' =>   array(    0 => 'occupation_type',    1 => 'job_title',    2 => 'industry',    3 => 'other_income_source',  ),  'Identification' =>   array(    0 => 'passport_no',    1 => 'pan_no',  ),  'Family Members' =>   array(    0 => 'family0',    1 => 'family1',    2 => 'family2',    3 => 'family3',    4 => 'family4',  ),);
  }

  public function getNewDisplay()
  {
    return array();
  }

  public function getListDisplay()
  {
    return array(  0 => 'id',  1 => 'first_name',  2 => 'last_name',  3 => 'email_address',  4 => 'username',  5 => 'algorithm',  6 => 'salt',  7 => 'password',  8 => 'is_active',  9 => 'is_super_admin',  10 => 'last_login',  11 => 'is_member',  12 => 'member_type_id',  13 => 'country',  14 => 'timezone',  15 => 'culture',  16 => 'middle_name',  17 => 'dob',  18 => 'passport_no',  19 => 'pan_no',  20 => 'occupation_type',  21 => 'job_title',  22 => 'industry',  23 => 'other_income_source',  24 => 'married',  25 => 'gender',  26 => 'marriage_anniversary',  27 => 'year_as_nri',  28 => 'created_at',  29 => 'updated_at',);
  }

  public function getFieldsDefault()
  {
    return array(
      'id' => array(  'is_link' => true,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'first_name' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'last_name' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'email_address' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'username' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'algorithm' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'salt' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'password' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'is_active' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Boolean',),
      'is_super_admin' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Boolean',),
      'last_login' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
      'is_member' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'member_type_id' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',),
      'country' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'timezone' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'culture' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'middle_name' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'dob' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
      'passport_no' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'pan_no' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'occupation_type' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'job_title' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'industry' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'other_income_source' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'married' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Boolean',),
      'gender' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Enum',),
      'marriage_anniversary' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
      'year_as_nri' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'created_at' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
      'updated_at' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
      'groups_list' => array(  'is_link' => false,  'is_real' => false,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'permissions_list' => array(  'is_link' => false,  'is_real' => false,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
    );
  }

  public function getFieldsList()
  {
    return array(
      'id' => array(),
      'first_name' => array(),
      'last_name' => array(),
      'email_address' => array(),
      'username' => array(),
      'algorithm' => array(),
      'salt' => array(),
      'password' => array(),
      'is_active' => array(),
      'is_super_admin' => array(),
      'last_login' => array(),
      'is_member' => array(),
      'member_type_id' => array(),
      'country' => array(),
      'timezone' => array(),
      'culture' => array(),
      'middle_name' => array(),
      'dob' => array(),
      'passport_no' => array(),
      'pan_no' => array(),
      'occupation_type' => array(),
      'job_title' => array(),
      'industry' => array(),
      'other_income_source' => array(),
      'married' => array(),
      'gender' => array(),
      'marriage_anniversary' => array(),
      'year_as_nri' => array(),
      'created_at' => array(),
      'updated_at' => array(),
      'groups_list' => array(),
      'permissions_list' => array(),
    );
  }

  public function getFieldsFilter()
  {
    return array(
      'id' => array(),
      'first_name' => array(),
      'last_name' => array(),
      'email_address' => array(),
      'username' => array(),
      'algorithm' => array(),
      'salt' => array(),
      'password' => array(),
      'is_active' => array(),
      'is_super_admin' => array(),
      'last_login' => array(),
      'is_member' => array(),
      'member_type_id' => array(),
      'country' => array(),
      'timezone' => array(),
      'culture' => array(),
      'middle_name' => array(),
      'dob' => array(),
      'passport_no' => array(),
      'pan_no' => array(),
      'occupation_type' => array(),
      'job_title' => array(),
      'industry' => array(),
      'other_income_source' => array(),
      'married' => array(),
      'gender' => array(),
      'marriage_anniversary' => array(),
      'year_as_nri' => array(),
      'created_at' => array(),
      'updated_at' => array(),
      'groups_list' => array(),
      'permissions_list' => array(),
    );
  }

  public function getFieldsForm()
  {
    return array(
      'id' => array(),
      'first_name' => array(),
      'last_name' => array(),
      'email_address' => array(),
      'username' => array(),
      'algorithm' => array(),
      'salt' => array(),
      'password' => array(),
      'is_active' => array(),
      'is_super_admin' => array(),
      'last_login' => array(),
      'is_member' => array(),
      'member_type_id' => array(),
      'country' => array(),
      'timezone' => array(),
      'culture' => array(),
      'middle_name' => array(),
      'dob' => array(),
      'passport_no' => array(),
      'pan_no' => array(),
      'occupation_type' => array(),
      'job_title' => array(),
      'industry' => array(),
      'other_income_source' => array(),
      'married' => array(),
      'gender' => array(),
      'marriage_anniversary' => array(),
      'year_as_nri' => array(),
      'created_at' => array(),
      'updated_at' => array(),
      'groups_list' => array(),
      'permissions_list' => array(),
    );
  }

  public function getFieldsEdit()
  {
    return array(
      'id' => array(),
      'first_name' => array(),
      'last_name' => array(),
      'email_address' => array(),
      'username' => array(),
      'algorithm' => array(),
      'salt' => array(),
      'password' => array(),
      'is_active' => array(),
      'is_super_admin' => array(),
      'last_login' => array(),
      'is_member' => array(),
      'member_type_id' => array(),
      'country' => array(),
      'timezone' => array(),
      'culture' => array(),
      'middle_name' => array(),
      'dob' => array(  'label' => 'Date of Birth',),
      'passport_no' => array(),
      'pan_no' => array(),
      'occupation_type' => array(),
      'job_title' => array(),
      'industry' => array(),
      'other_income_source' => array(),
      'married' => array(),
      'gender' => array(),
      'marriage_anniversary' => array(),
      'year_as_nri' => array(  'label' => 'NRI Since',  'help' => 'Select the year since you became a NRI.',),
      'created_at' => array(),
      'updated_at' => array(),
      'groups_list' => array(),
      'permissions_list' => array(),
    );
  }

  public function getFieldsNew()
  {
    return array(
      'id' => array(),
      'first_name' => array(),
      'last_name' => array(),
      'email_address' => array(),
      'username' => array(),
      'algorithm' => array(),
      'salt' => array(),
      'password' => array(),
      'is_active' => array(),
      'is_super_admin' => array(),
      'last_login' => array(),
      'is_member' => array(),
      'member_type_id' => array(),
      'country' => array(),
      'timezone' => array(),
      'culture' => array(),
      'middle_name' => array(),
      'dob' => array(),
      'passport_no' => array(),
      'pan_no' => array(),
      'occupation_type' => array(),
      'job_title' => array(),
      'industry' => array(),
      'other_income_source' => array(),
      'married' => array(),
      'gender' => array(),
      'marriage_anniversary' => array(),
      'year_as_nri' => array(),
      'created_at' => array(),
      'updated_at' => array(),
      'groups_list' => array(),
      'permissions_list' => array(),
    );
  }


  /**
   * Gets the form class name.
   *
   * @return string The form class name
   */
  public function getFormClass()
  {
    return 'memberForm';
  }

  public function hasFilterForm()
  {
    return true;
  }

  /**
   * Gets the filter form class name
   *
   * @return string The filter form class name associated with this generator
   */
  public function getFilterFormClass()
  {
    return 'memberFormFilter';
  }

  public function getPagerClass()
  {
    return 'sfDoctrinePager';
  }

  public function getPagerMaxPerPage()
  {
    return 20;
  }

  public function getDefaultSort()
  {
    return array(null, null);
  }

  public function getTableMethod()
  {
    return '';
  }

  public function getTableCountMethod()
  {
    return '';
  }
}
