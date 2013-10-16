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
    
    $this->widgetSchema['member_type_id'] = new sfWidgetFormDoctrineChoice(array("model"=>"member_type"));
    $this->validatorSchema['member_type_id'] = new sfValidatorDoctrineChoice(array("model"=>"member_type"));
  }
}
