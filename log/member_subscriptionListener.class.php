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
       
        if(!$record->getItrProductId())
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
            }
        }        
    }    
}

?>