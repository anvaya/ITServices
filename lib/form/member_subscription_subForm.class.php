<?php

/**
 * Description of member_subscription_subForm
 *
 * @author Mrugendra Bhure
 */
class member_subscription_subForm extends member_subscriptionForm
{
    public function configure() 
    {
        parent::configure();
        
        $this->widgetSchema['member_coupon_id'] = new sfWidgetFormInputHidden();
        $this->validatorSchema['member_coupon_id']->setOption('required', false);
        
        $this->widgetSchema['coupon_code'] = new sfWidgetFormInputText();
        $this->validatorSchema['coupon_code'] = new sfValidatorString(array("required"=>false) );
        
        $this->validatorSchema['subscription_id']->setOption('required', true);
        $this->widgetSchema['price'] = new sfWidgetFormInputHidden();                
        unset($this['active'], $this['member_id'], $this['start_date'],$this['end_date'], $this['created_at'], $this['updated_at']);        
        $this->mergePostValidator(new memberSubscriptionSubFormValidator(null, array(), array("invalid"=>"The coupon code you entered is invalid.") ));        
    }
}

?>