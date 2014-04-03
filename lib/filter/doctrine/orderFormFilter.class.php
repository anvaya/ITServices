<?php

/**
 * order filter form.
 *
 * @package    BestBuddies
 * @subpackage filter
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class orderFormFilter extends BaseorderFormFilter
{
  public function configure()
  {
      
      $this->widgetSchema['status'] = new sfWidgetFormChoice(array("choices"=> orderTable::$ORDER_STATUS_CHOICES_WITH_EMPTY ));
      $this->validatorSchema['status'] = new sfValidatorChoice(array("choices"=> array_keys(orderTable::$ORDER_STATUS_CHOICES_WITH_EMPTY),"required"=>false ));
      
  }
  
  public function getFields() {
      $fields = parent::getFields();
      $fields['status'] = 'ForeignKey';
      return $fields;
  }
}
