<?php

/**
 * payment form.
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class paymentForm extends BasepaymentForm
{
  public function configure()
  {
    unset($this['created_at'],$this['updated_at'],$this['status']);
    
    $this->widgetSchema['subscription_id'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['member_id'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['submission_id'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['payment_type'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['status'] = new sfWidgetFormInputHidden();
    $this->widgetSchema['ip_address'] = new sfWidgetFormInputHidden();
    
    $date_widget = new sfWidgetFormDate(array("format"=>"%day%/%month%/%year%"));
    $this->widgetSchema['payment_date'] = new sfWidgetFormJQueryDate(array("date_widget"=>$date_widget));
    
    $this->widgetSchema['amount'] = new sfWidgetFormInputText(array(),array('readonly'=>'readonly'));
    $this->widgetSchema['transaction_id'] = new sfWidgetFormInputText(array('label'=>'Transaction Id'),array());
    
    $this->setDefault('member_id', $this->getOption('member_id'));
    $this->setDefault('submission_id', $this->getOption('submission_id'));
    $this->setDefault('ip_address', $this->getOption('ip_address'));
    $this->setDefault('payment_type', paymentTable::STATUS_BANK_PAYMENT);
    $this->setDefault('payment_date',date('Y-m-d'));
    $this->setDefault('status', $this->getOption('status'));
    $this->setDefault('subscription_id', $this->getOption('subscription_id'));
    $this->validatorSchema['status'] = new sfValidatorPass();
    
    $this->validatorSchema['bank_name'] = new sfValidatorString(array('required'=>true));
    $this->validatorSchema['branch'] = new sfValidatorString(array('required'=>true));
    $this->validatorSchema['payment_ref_no'] = new sfValidatorString(array('required'=>true));
    $this->validatorSchema['transaction_id'] = new sfValidatorString(array('required'=>true));
    
    $amount = $this->getOption("amount"); //Doctrine::getTable('settings')->find('pan_application_fee');
    $this->setDefault('amount', $amount);
    
  }
}
