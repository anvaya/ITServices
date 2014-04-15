<?php

/**
 * cart actions.
 *
 * @package    BestBuddies
 * @subpackage cart
 * @author     Anvaya Technologies
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class cartActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->carts = false;
    $member_id = $this->getUser()->getGuardUser()->getId();
    $cart = Doctrine_Core::getTable('cart')->findOneByMemberId($member_id);
    if($cart)
    {
        $this->shoppingCart = $cart;
        $this->carts = Doctrine_Core::getTable('cart_items')
          ->createQuery('a')
          ->where('a.cart_id = ?',  $cart->getId())
          ->execute();
    }else
        $this->getUser()->setFlash('notice', 'Cart is empty.');
  }

  public function executeApplyCoupon(sfWebRequest $request)
  {
      $this->forward404Unless($request->getParameter('code'));
      $code = $request->getParameter('code');
      
      $coupon =  member_couponTable::getInstance()
              ->createQuery('mc')
              ->addWhere('mc.coupon_code = ?', $code)
              ->addWhere('mc.used is null or mc.used = 0')
              ->fetchOne();
      
      $member_id = $this->getUser()->getGuardUser()->getId();
      $cart = Doctrine_Core::getTable('cart')->findOneByMemberId($member_id);
      $invalid = true;
              
      if($cart && $coupon)
      {          
          if( ($product_id = $coupon->getProductId()) )
          {
             $product_cnt = Doctrine_Core::getTable('cart_items')
                                ->createQuery('a')                                
                                ->addWhere('a.cart_id = ?',  $cart->getId())
                                ->addWhere('a.product_id = ?', $product_id)
                                ->count();
             
             if($product_cnt > 0)
             {
                 $invalid = false;
             }             
          }
          else
          {
            $invalid = false;
          }
      }
      
      if($invalid)
      {
         $this->getUser()->setFlash('notice','Invalid Coupon.'); 
      }
      else
      {
        $cart->setMemberCouponId($coupon->getId());    
        $cart->save();
      }
      
      $this->redirect("@cart_index");
  }
  
  
  
  public function executeClear(sfWebRequest $request)
  {
      $member_id = $this->getUser()->getGuardUser()->getId();
      
      cartTable::getInstance()
              ->createQuery('cc')
              ->delete()
              ->addWhere('member_id = ?', $member_id)
              ->execute();
      
      $this->redirect("@product_index?page=1");
  }
  
  public function executeCheckout(sfWebRequest $request)
  {
      $member_id = $this->getUser()->getGuardUser()->getId();
      $cart = Doctrine_Core::getTable('cart')->findOneByMemberId($member_id);
      if($cart)
      {                   
          /* @var $cart cart */
          $order = new order();
          $order->setStatus(orderTable::ORDER_STATUS_PENDING);
          $order->setMemberId($member_id);
          $order->setOrderNo(date('YmdHis'));
          $order->setOrderDate(date('Y-m-d H:i:s'));
          
                    
          $amount = 0;
          
          foreach($cart->getCartItems() as $cart_item) /* @var $cart_item cart_items */
          {
              $order_item = new order_item();
              $order_item->setOrder($order);
              $order_item->setProductId($cart_item->getProductId() );
              $order_item->setQuantity(1);
              $order_item->setPrice($cart_item->getPrice());              
              
              $order->getOrderItem()->add($order_item);
              
              $amount += $cart_item->getPrice();
          }
          
          $order->setGrossAmount($amount);
          
          if ( ($coupon = $cart->getMemberCoupon()) )
          {   
              $disc_amount = $coupon->getCoupon()->getDiscountRate();
              $order->setDiscountVoucherNo($coupon->getCouponCode());
              $order->setDiscountAmount($disc_amount);              
              $amount -= $disc_amount;
          }                   
          
          $order->setNetAmount($amount);
          
          $order->save();
          
          cartTable::getInstance()
              ->createQuery('cc')
              ->delete()
              ->addWhere('member_id = ?', $member_id)
              ->execute();
          
          $this->sendOrderPayEmail($order);
          $this->redirect("cart/orderPlaced?id=".$order->getId());
      }
      
      $this->forward404();
  }
  
  public function executeOrderPlaced(sfWebRequest $request)
  {
      $order = orderTable::getInstance()->find($request->getParameter("id",0));
      
      if(!$order)
      {
          $this->forward404();
      }    
      
      try 
      {          
      
          
      } catch (Exception $ex) 
      {
          
      }
      
      $this->order = $order;
  }
  
  public function executeAdd(sfWebRequest $request)
  {
    $member_id = $this->getUser()->getGuardUser()->getId();  
    $cart = Doctrine_Core::getTable('cart')->findOneByMemberId($member_id);
    if($cart)
    {
        $cart_id = $cart->getId();
    }else
    {
        $cart = new cart();
        $cart->setMemberId($member_id);
        $cart->setIpAddress($this->getRealIpAddress());
        $cart->save();
        $cart_id = $cart->getId();
    }
    
    $cart_item = Doctrine_Core::getTable('cart_items')->findOneByCartIdAndProductId($cart_id, $request->getParameter('id'));
    if($cart_item)
    {
        $this->getUser()->setFlash('notice', 'Product already exists in cart.');
    }
    else
    {
        $product = Doctrine_Core::getTable('product')->find(array($request->getParameter('id')));
        if($product)
        {
            $cart_items = new cart_items();
            $cart_items->setCartId($cart_id);
            $cart_items->setProductId($request->getParameter('id'));
            $cart_items->setQuantity(1);
            $cart_items->setPrice($product->getPrice());
            $cart_items->save();
            $this->getUser()->setFlash('notice', 'Product added to Cart.');
        }  else {
            $this->getUser()->setFlash('error', 'Product not Found.');
        }
    }

    $this->redirect('@cart_index');
  }
  
  private function getRealIpAddress()
  {
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
  }
  
  public function executeNew(sfWebRequest $request)
  {
    $this->form = new cartForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new cartForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($cart = Doctrine_Core::getTable('cart')->find(array($request->getParameter('id'))), sprintf('Object cart does not exist (%s).', $request->getParameter('id')));
    $this->form = new cartForm($cart);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($cart = Doctrine_Core::getTable('cart')->find(array($request->getParameter('id'))), sprintf('Object cart does not exist (%s).', $request->getParameter('id')));
    $this->form = new cartForm($cart);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($cart = Doctrine_Core::getTable('cart')->find(array($request->getParameter('id'))), sprintf('Object cart does not exist (%s).', $request->getParameter('id')));
    $cart->delete();

    $this->redirect('cart/index');
  }

  private function sendOrderPayEmail(order $order)
  {
      try
      {
          $user = memberTable::getInstance()->find($this->getUser()->getGuardUser()->getId());
          $body = $this->getPartial("email_payment", array("user"=>$user,"order"=>$order));

          //file_put_contents(sfConfig::get('sf_log_dir')."/email_payment.html", $body);

          $msg = $this->getMailer()->compose();
          $msg->setSubject("Order #".$order->getOrderNo()." Please complete your payment.");
          $msg->addFrom("nriservices@groworth.in","Groworth Real Solutions Pvt. Ltd");
          $msg->addReplyTo("nrihelp@groworth.in", "Groworth Real Solutions Pvt. Ltd");
          $msg->addTo($user->getEmailAddress() , $user->getFirstName()." ".$user->getLastName() );            
          $msg->setBody($body, 'text/html', "utf-8");
          $this->getMailer()->sendNextImmediately();
          $this->getMailer()->send($msg);

          $msg = $this->getMailer()->compose();
          $msg->setSubject("Order #".$order->getOrderNo()." Please complete your payment.");
          $msg->addFrom("nriservices@groworth.in","Groworth Real Solutions Pvt. Ltd");
          $msg->addReplyTo("nrihelp@groworth.in", "Groworth Real Solutions Pvt. Ltd");
          $msg->addTo("sandeep.groworth@gmail.com","Sandeep Ghadge");            
          $msg->addTo("mrugendrabhure@gmail.com","Mrugendra Bhure");            
          $msg->setBody($body, 'text/html', "utf-8");
          $this->getMailer()->sendNextImmediately();
          $this->getMailer()->send($msg);
          
          return true;
      }catch(Exception $ex)
      {
          return false;
      }
  }
  
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $cart = $form->save();

      $this->redirect('cart/edit?id='.$cart->getId());
    }
  }
}
