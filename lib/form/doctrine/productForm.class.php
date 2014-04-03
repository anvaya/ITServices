<?php

/**
 * product form.
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class productForm extends BaseproductForm
{
  public function configure()
  {
      $date_widget = new sfWidgetFormDate(array('format'=>'%day%/%month%/%year%'));
      $date_config = array('config'=>'{dateFormat: "dd/MMM/yy"}','date_widget'=>$date_widget );            
      
      $this->widgetSchema['expiry_date'] = new sfWidgetFormJQueryDate($date_config);    
      $this->validatorSchema['billing_unit_id'] = new sfValidatorPass();
  }
}
