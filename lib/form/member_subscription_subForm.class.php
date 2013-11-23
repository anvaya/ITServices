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
        $this->validatorSchema['subscription_id']->setOption('required', true);
        $this->widgetSchema['price'] = new sfWidgetFormInputHidden();                
        unset($this['active'], $this['member_id'], $this['start_date'],$this['end_date']);        
        $this->mergePostValidator(new memberSubscriptionSubFormValidator());        
    }
}

?>