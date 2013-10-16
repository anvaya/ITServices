<?php

/**
 * submission filter form.
 *
 * @package    BestBuddies
 * @subpackage filter
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class submissionFormFilter extends BasesubmissionFormFilter
{
  public function configure()
  {
      $this->widgetSchema["program_year"] = new sfWidgetFormChoice(array("choices"=>array()));
      $this->validatorSchema["program_year"] = new sfValidatorChoice(array("choices"=>array()));
      
      $widget = new sfWidgetFormJQueryDate();
      $this->widgetSchema['created_at'] = new sfWidgetFormFilterDate(array('from_date' => $widget, 'to_date' => $widget, 'with_empty' => false));
  }
  
  public function addProgramYearColumnQuery($query, $column, $values)
  {
      
  }
}
