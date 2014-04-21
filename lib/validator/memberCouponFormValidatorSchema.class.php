<?php
/**
 * Description of memberCouponFormValidatorSchema
 *
 * @author Mrugendra Bhure
 */
class memberCouponFormValidatorSchema extends sfValidatorSchema
{
    public function clean($values) 
    {
        if(isset($values['coupon_code']) && !$values['coupon_code'])
        {
            $values['coupon_code'] = member_couponTable::generateNewCode();
        }
        return $values;
    }    
}

?>