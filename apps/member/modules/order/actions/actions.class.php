<?php

/**
 * order actions.
 *
 * @package    BestBuddies
 * @subpackage order
 * @author     Anvaya Technologies
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class orderActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function execute(sfWebRequest $request)
  {
    $cart = Doctrine_Core::getTable('cart')->findOneByMemberId($this->getUser()->getAttribute('user_id',null,'sfGuardSecurityUser'));
    if($cart)
    {
        $order = new order();
        $order->setMemberId($this->getUser()->getAttribute('user_id',null,'sfGuardSecurityUser'));
        $order->setOrderDate(date('Y-m-d H:i:s'));
        $order->save();

        $order_id = $order->getId();
        
        $cart_items = Doctrine_Core::getTable('cart_items')
          ->createQuery('a')
          ->where('a.cart_id = ?',  $cart->getId())
          ->execute();
        
        foreach($cart_items as $cart_item)
        {
            $order_item = new order_item();
            $order_item->setOrderId($order_id);
            $order_item->setProductId($cart_item->getProductId());
            $order_item->setQuantity($cart_item->getQuantity());
            $order_item->setPrice($cart_item->getPrice());
            $order_item->save();
        }
    }
  }
}
