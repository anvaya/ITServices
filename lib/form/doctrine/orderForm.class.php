<?php

/**
 * order form.
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class orderForm extends BaseorderForm
{
  public function configure()
  {
      $this->widgetSchema['status'] = new sfWidgetFormChoice(array("choices"=> orderTable::$ORDER_STATUS_CHOICES ));
      $this->validatorSchema['status'] = new sfValidatorChoice(array("choices"=> array_keys(orderTable::$ORDER_STATUS_CHOICES),"required"=>false ));
      
      $this->useFields(array("status"));
  }
}
