<?php
/**
 * Description of memberSubscriptionSubFormValidator
 *
 * @author Mrugendra Bhure
 */
class memberSubscriptionSubFormValidator extends sfValidatorSchema
{
    protected function doClean($values)
    {
        if(isset($values['subscription_id']))
        {
            $subscription = subscriptionTable::getInstance()
                            ->find($values['subscription_id']);
            /* @var $subscription subscription */
            $values['price'] = $subscription->getPrice();
        }
        return $values;
    }    
}

?>