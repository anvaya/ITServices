<?php
/**
 * Description of member_subscriptionListener
 *
 * @author Mrugendra Bhure
 */
class member_subscriptionListener extends Doctrine_Record_Listener
{
    public function preSave(Doctrine_Event $event) 
    {
        parent::preSave($event);
        $record = $event->getInvoker();
        /* @var $record member_subscription */
       
        //if(!$record->getItrProductId())
        {
            $subscription = $record->getSubscriptionId();

            $itr_product = subscription_productTable::getInstance()
                            ->createQuery('sp')
                            ->innerJoin('sp.product p')
                            ->addWhere('p.category_id = ?', productTable::CATEGORY_IT_RETURNS)
                            ->fetchOne();

            if($itr_product)
            {
                $record->setItrProductId($itr_product->getProductId());
                //$record->save();
            }
        }                
    }    
    
    public function postSave(Doctrine_Event $event) 
    {
        parent::postSave($event);
        $record = $event->getInvoker();
        
        /* @var $record member_subscription */
        if(!$record->getMemberCouponId() && $record->getActive() && $record->getMember()->getMarried() ) //Check if this subscription used a coupon
        {
           $already_issued = member_couponTable::getInstance()  
                                ->createQuery('mc') 
                                ->innerJoin('mc.coupon c') 
                                ->addWhere('mc.member_id = ?', $record->getMemberId())
                                ->addWhere('c.coupon_type = ?', couponTable::COUPON_TYPE_SPOUCE_DISCOUNT)                                
                                ->addWhere('mc.used is null or mc.used = 0')
                                ->count();
           
           if($already_issued == 0)
           {               
                $coupon = new member_coupon();
                $coupon->setMemberId($record->getMemberId());
                $coupon->setCouponId(1);
                $coupon->setCouponCode(member_couponTable::generateNewCode());
                $coupon->save();               
           }
        }
        else if($record->getMemberCouponId () && $record->getActive())
        {
            //Mark the coupon as used.
            $member_coupon = $record->getMemberCoupon();
            if($member_coupon)
            {
                $member_coupon->setUsed(true);
                $member_coupon->save();
            }
        }
    }
    
}

?>