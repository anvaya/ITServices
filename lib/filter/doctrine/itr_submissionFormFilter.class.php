<?php

/**
 * itr_submission filter form.
 *
 * @package    BestBuddies
 * @subpackage filter
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class itr_submissionFormFilter extends Baseitr_submissionFormFilter
{
  public function configure()
  {
      $choices = array(            
            ""=>"Pending",
            "1"=>"Processing",
            "2"=>"Awaiting Customer Reply",
            "3"=>"Filed"
                );
        
        $this->widgetSchema['status'] = new sfWidgetFormChoice(array("choices"=>$choices));
        $this->validatorSchema['status'] = new sfValidatorChoice(array("choices"=>array_keys($choices),"required"=>false));
        $this->useFields(array("notes","status"));
  }
  
  public function getFields() 
 {
    $fields =  parent::getFields();
    $fields['status'] = 'ForeignKey';
    return $fields;
  }
}
