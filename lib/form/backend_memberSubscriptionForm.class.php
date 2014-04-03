<?php

/**
 * Description of backend_memberSubscriptionForm
 *
 * @author Mrugendra Bhure
 */
class backend_memberSubscriptionForm extends member_subscriptionForm
{
    public function configure() 
    {
        parent::configure();
        $this->useFields(array('subscription_id'));        
    }
}

?>