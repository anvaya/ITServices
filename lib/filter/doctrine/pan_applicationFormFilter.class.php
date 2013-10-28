<?php

/**
 * pan_application filter form.
 *
 * @package    BestBuddies
 * @subpackage filter
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class pan_applicationFormFilter extends Basepan_applicationFormFilter
{
  /**
   * @see submissionFormFilter
   */
  public function configure()
  {
    parent::configure();
    unset($this["form_id"],$this["updated_at"],$this["program_year"],$this["submission_ip"],$this["archieved"]);
    
    $choices = pan_applicationTable::$STATUS_TYPES;
    $this->widgetSchema['status'] = new sfWidgetFormChoice(array("choices"=> $choices));
    $this->validatorSchema['status'] = new sfValidatorChoice(array("choices"=> array_keys($choices)));
    
    $this->widgetSchema['status'] = new sfWidgetFormFilterMultiCondition(array('value_widget'=>$this->widgetSchema['status'],'field_type'=>'foreign') );
    $this->validatorSchema['status'] = new sfValidatorFormMultiCondition( array('value_validator'=>$this->validatorSchema['status'],'field_type'=>'foreign') );

  }
  
  public function addStatusColumnQuery(Doctrine_Query $query, $column, $value=false)
  {
      sfWidgetFormFilterMultiCondition::addColumnQuery($query, $column, $value, 'foreign');
  }
  
  public function getFields()
  {
    $fields= parent::getFields();
      $fields['status']='ForeignKey';
      return $fields;
  }
}
