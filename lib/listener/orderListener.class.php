<?php
/**
 * Description of orderListener
 *
 * @author Mrugendra Bhure
 */
class orderListener extends Doctrine_Record_Listener
{    
    public function postSave(Doctrine_Event $event) 
    {    
        $order  = $event->getInvoker();
        
        /* @var $order order */
        if($order->getDiscountVoucherNo())
        {
            $coupon = member_couponTable::getInstance()
                            ->findOneByCouponCode($order->getDiscountVoucherNo());
            
            /* @var $coupon member_coupon */
            if($coupon && !$coupon->getUsed())
            {
                $coupon->setUsed(1);
                $coupon->save();
            }
        }
    }
}

?>