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
        
        if(isset($values['coupon_code']) && $values['coupon_code'])
        {
            $errorSchema = new sfValidatorErrorSchema($this);  
            
            $member_coupon = member_couponTable::getInstance()
                                    ->createQuery('mc')
                                    ->addWhere('mc.coupon_code = ?', $values['coupon_code'])
                                    ->addWhere('mc.used is null or mc.used = 0')
                                    ->fetchOne();
            
            /* @var $member_coupon member_coupon */
            if($member_coupon)
            {
                $values['member_coupon_id'] = $member_coupon->getId();
                unset($values['coupon_code']);
            }  
            else
            {
                $errorSchema->addError(new sfValidatorError($this,'invalid'), 'coupon_code');                
            }
            
            if(count($errorSchema)>0)
            {
                throw new sfValidatorErrorSchema($this, $errorSchema);
            }
        }
        
        return $values;
    }    
}

?>