<?php

require_once dirname(__FILE__).'/../lib/orderGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/orderGeneratorHelper.class.php';

/**
 * order actions.
 *
 * @package    BestBuddies
 * @subpackage order
 * @author     Anvaya Technologies
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class orderActions extends autoOrderActions
{
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $old_order = clone $form->getObject();  
      
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

      try {
        $order = $form->save();
      } catch (Doctrine_Validator_Exception $e) {

        $errorStack = $form->getObject()->getErrorStack();

        $message = get_class($form->getObject()) . ' has ' . count($errorStack) . " field" . (count($errorStack) > 1 ?  's' : null) . " with validation errors: ";
        foreach ($errorStack as $field => $errors) {
            $message .= "$field (" . implode(", ", $errors) . "), ";
        }
        $message = trim($message, ', ');

        $this->getUser()->setFlash('error', $message);
        return sfView::SUCCESS;
      }

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $order)));

      /* @var $old_order order */
      /* @var $order order */
      if($old_order->getStatus()!=orderTable::ORDER_STATUS_PAID && $order->getStatus()==orderTable::ORDER_STATUS_PAID)
      {
          $this->sendCustomerEmail($order);
      }
      
      
      if ($request->hasParameter('_save_and_add'))
      {
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');

        $this->redirect('@order_new');
      }
      else
      {
        $this->getUser()->setFlash('notice', $notice);

        $this->redirect(array('sf_route' => 'order_edit', 'sf_subject' => $order));
      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
  
  private function sendCustomerEmail(order $order)
  {
      try
      {
          $products = order_itemTable::getInstance()
            ->createQuery('oi')
            ->innerJoin('oi.product pr')
            ->select('pr.name as product_name, oi.price')
            ->addWhere('oi.order_id = ?', $order->getId())
            ->fetchArray();
          
         $amount =0;
         foreach($products as $pr)
         {
             $amount += $pr['price'];
         }
         
         $member = $order->getMember();// $this->getUser()->getGuardUser();
         $email_body =  $this->getPartial("email_order_complete_customer", array("user"=>$member,"order"=>$order,"products"=>$products,"amount"=>$amount));
         
         $msg = $this->getMailer()->compose();
         $msg->setSubject("Payment Received for Order #".$order->getOrderNo());
         $msg->addFrom("nriservices@groworth.in","Groworth Real Solutions Pvt. Ltd");
         $msg->addReplyTo("nrihelp@groworth.in", "Groworth Real Solutions Pvt. Ltd");
         $msg->addTo($member->getEmailAddress() , $member->getFirstName() );            
         $msg->setBody($email_body, 'text/html', "utf-8");
         $this->getMailer()->sendNextImmediately();
         $this->getMailer()->send($msg);
              
         $msg = $this->getMailer()->compose();
         $msg->setSubject("Payment Received for Order #".$order->getOrderNo());
         $msg->addFrom("nriservices@groworth.in","Groworth Real Solutions Pvt. Ltd");
         $msg->addReplyTo("nrihelp@groworth.in", "Groworth Real Solutions Pvt. Ltd");
         $msg->addTo("sandeep.groworth@gmail.com","Sandeep Ghadge");    
         $msg->addTo("mrugendrabhure@gmail.com","Mrugendra Bhure" );            
         $msg->setBody($email_body, 'text/html', "utf-8");
         $this->getMailer()->sendNextImmediately();
         $this->getMailer()->send($msg);
         
      } catch (Exception $ex) {

      }
  }
}
