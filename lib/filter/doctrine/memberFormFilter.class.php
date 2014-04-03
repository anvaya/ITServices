<?php

/**
 * member filter form.
 *
 * @package    BestBuddies
 * @subpackage filter
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class memberFormFilter extends BasememberFormFilter
{
  /**
   * @see sfGuardUserFormFilter
   */
  public function configure()
  {
    parent::configure();
    
    $this->widgetSchema['member_type_id'] = new sfWidgetFormDoctrineChoice(array("model"=>"member_type","add_empty"=>true));
    $this->validatorSchema['member_type_id'] = new sfValidatorDoctrineChoice(array("model"=>"member_type","required"=>false));
    
    $this->widgetSchema['country'] = new sfWidgetFormI18nChoiceCountry(array("add_empty" => true));
     $this->validatorSchema['country'] = new sfValidatorI18nChoiceCountry(array("required" => false));

  }
  
  public function getFields() {
      $fields = parent::getFields();
      $fields['country'] = 'ForeignKey';
      $fields['member_type_id'] = 'ForeignKey';
      return $fields;
  }
}
