<?php

require_once dirname(__FILE__).'/../lib/memberGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/memberGeneratorHelper.class.php';
require_once sfConfig::get('sf_lib_dir').'/vendor/tcpdf/tcpdf.php';

/**
 * member actions.
 *
 * @package    BestBuddies
 * @subpackage member
 * @author     Anvaya Technologies
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class memberActions extends autoMemberActions
{
  public function executeShow(sfWebRequest $request)
  {
    $this->member = $this->getRoute()->getObject();
  }
  
  public function executeAjaxAutoComplete(sfWebRequest $request)
  {       
        $match = $request->getParameter('term', "");
        $limit = $request->getParameter('limit', 20);

        
        $list = memberTable::getInstance()->getListForAjax($match, $limit);
        
        $this->renderText(json_encode($list));
        return sfView::NONE;
  }
  
  public function executeActivateMember(sfWebRequest $request)
  {
      $this->form = new activateMemberForm();
  }
  
  public function executeActivate(sfWebRequest $request)
  {
      $member = $this->getRoute()->getObject();
      /* @var $member member */
      $sid = $request->getParameter('sid', false);
      
      $subscription = member_subscriptionTable::getInstance() 
                        ->createQuery('ms')
                        ->addWhere('ms.member_id = ?', $member->getId())              
                        ->orderBy('ms.id desc')
                        ->fetchOne();
      
      $old_subscriptions = member_subscriptionTable::getInstance()
                            ->createQuery('ms')
                            ->addWhere('ms.member_id = ?', $member->getId())
                            ->addWhere('ms.id <> ?', $subscription->getId())
                            ->count();
      
      $result = 0;
      
      if($subscription)
      {
                    
          $member->setIsActive(1);
          $member->save();
          
          /* @var $subscription member_subscription */
          if($sid)
          {
              $subscription->setSubscriptionId($sid);              
          }
          $subscription->setActive(1);
          $subscription->save();
          
          if($old_subscriptions > 0)
          {
              member_subscriptionTable::getInstance()
                        ->createQuery()
                        ->update()
                        ->set('active',0)
                        ->addWhere('member_id = ?', $member->getId())
                        ->addWhere('id <> ?', $subscription->getId())
                        ->execute();
              
              $notice     = "The subscription has been renewed.";
              $email_body = $this->getPartial("email_renewal", array("user"=>$member, "subscription"=>$subscription));
              $subject    = "Your Groworth.in subscription has been renewed";
          }
          else
          {
              $notice = 'The account has been activated';            
              $email_body = $this->getPartial("email_activation", array("user"=>$member, "subscription"=>$subscription));
              $subject    = "You Groworth.in account is now active";
          }
          
          $this->getUser()->setFlash('notice',$notice);
          
          try
          {
            $mailer =  $this->getMailer();
            
            $msg = $mailer->compose();
            $msg->setSubject($subject);
            $msg->addFrom("nriservices@groworth.in","Groworth Real Solutions Pvt. Ltd");
            $msg->addReplyTo("nrihelp@groworth.in", "Groworth Real Solutions Pvt. Ltd");
            $msg->addTo($member->getEmailAddress() , $member->getFirstName() );            
            $msg->setBody($email_body, 'text/html', "utf-8");
            $mailer->sendNextImmediately();
            $mailer->send($msg);
              
            $msg = $mailer->compose();
            $msg->setSubject($subject);
            $msg->addFrom("nriservices@groworth.in","Groworth Real Solutions Pvt. Ltd");
            $msg->addReplyTo("nrihelp@groworth.in", "Groworth Real Solutions Pvt. Ltd");
            $msg->addTo("sandeep.groworth@gmail.com","Sandeep Ghadge");    
            $msg->addCc("mrugendrabhure@gmail.com","Mrugendra Bhure" );            
            $msg->setBody($email_body, 'text/html', "utf-8");
            $mailer->sendNextImmediately();
            $mailer->send($msg);
            
            
            {
                $coupon = member_couponTable::getInstance()
                            ->createQuery('mc')
                            ->innerJoin('mc.coupon c')
                            ->addWhere('mc.member_id = ?', $member->getId())
                            ->addWhere('mc.used is null or mc.used = 0')                        
                            ->addWhere('c.coupon_type = ?', couponTable::COUPON_TYPE_SPOUCE_DISCOUNT )
                            ->orderBy('mc.id desc')
                            ->fetchOne();

                if($coupon)
                {                
                    /* @var $coupon member_coupon */

                    $coupon_code = $coupon->getCouponCode();
                    $valid_till  = format_date($subscription->getSubscription()->getEndDate(),"dd/MM/y");
                    
                    //If spouce registered, offer this as a renewal coupon.
                    if($member->isSpouceRegistered())                    
                    {
                        $email_body = $this->getPartial("email_coupon_renewal", array("user"=>$member, "subscription"=>$subscription,"valid_till"=>$valid_till, "coupon_code"=>$coupon_code));
                    }
                    else
                    {
                        $email_body = $this->getPartial("email_coupon", array("user"=>$member, "subscription"=>$subscription,"valid_till"=>$valid_till, "coupon_code"=>$coupon_code));
                    }
                    
                    $spouce = $member->getGender()=="M"?"wife":"husband";

                    $msg = $mailer->compose();
                    $msg->setSubject("Important news for your ".$spouce);
                    $msg->addFrom("nriservices@groworth.in","Groworth Real Solutions Pvt. Ltd");
                    $msg->addReplyTo("nrihelp@groworth.in", "Groworth Real Solutions Pvt. Ltd");
                    $msg->addTo($member->getEmailAddress() , $member->getFirstName() );
                    $msg->setBody($email_body, 'text/html', "utf-8");
                    $mailer->sendNextImmediately();
                    $mailer ->send($msg);

                    $msg = $mailer->compose();
                    $msg->addFrom("nriservices@groworth.in","Groworth Real Solutions Pvt. Ltd");
                    $msg->setSubject("Important news for your ".$spouce);
                    $msg->addTo("sandeep.groworth@gmail.com","Sandeep Ghadge");    
                    $msg->addCc("mrugendrabhure@gmail.com","Mrugendra Bhure" );
                    $msg->addReplyTo("nrihelp@groworth.in", "Groworth Real Solutions Pvt. Ltd");
                    $msg->setBody($email_body, 'text/html', "utf-8");
                    $mailer->sendNextImmediately();
                    $mailer ->send($msg);
                }
                
                $coupon = false;
                $coupon = member_couponTable::getInstance()
                            ->createQuery('mc')
                            ->innerJoin('mc.coupon c')
                            ->addWhere('mc.member_id = ?', $member->getId())
                            ->addWhere('mc.used is null or mc.used = 0')                        
                            ->addWhere('c.coupon_type = ?', couponTable::COUPON_TYPE_BACK_YEAR_ITR )
                            ->orderBy('mc.id desc')
                            ->fetchOne();

                if($coupon)
                {              
                    $current_product = productTable::getInstance()->find($subscription->getItrProductId());
                    $coupon_product = productTable::getInstance()->find($coupon->getProductId());
                    
                    /* @var $coupon_product product */
                    if($coupon_product->getExpired())
                    {
                        
                    }
                    else
                    {
                        /* @var $coupon member_coupon */
                        $coupon_code = $coupon->getCouponCode();
                        $valid_till  = format_date($subscription->getSubscription()->getEndDate(),"dd/MM/y");
                        $email_body = $this->getPartial("email_coupon_backyear", array("current_fy"=>$current_product->getFy()."-".($current_product->getFy()+1), "prev_fy"=>$coupon_product->getFy()."-".($coupon_product->getFy()+1), "user"=>$member, "subscription"=>$subscription,"valid_till"=>$valid_till, "coupon_code"=>$coupon_code));
                        
                        $msg = $mailer->compose();
                        $msg->setSubject("Important News for You");
                        $msg->addFrom("nriservices@groworth.in","Groworth Real Solutions Pvt. Ltd");
                        $msg->addReplyTo("nrihelp@groworth.in", "Groworth Real Solutions Pvt. Ltd");
                        $msg->addTo($member->getEmailAddress() , $member->getFirstName() );
                        $msg->setBody($email_body, 'text/html', "utf-8");
                        $mailer->sendNextImmediately();
                        $mailer ->send($msg);

                        $msg = $mailer->compose();
                        $msg->addFrom("nriservices@groworth.in","Groworth Real Solutions Pvt. Ltd");
                        $msg->setSubject("Important news for you");
                        $msg->addTo("sandeep.groworth@gmail.com","Sandeep Ghadge");    
                        $msg->addCc("mrugendrabhure@gmail.com","Mrugendra Bhure" );
                        $msg->addReplyTo("nrihelp@groworth.in", "Groworth Real Solutions Pvt. Ltd");
                        $msg->setBody($email_body, 'text/html', "utf-8");
                        $mailer->sendNextImmediately();
                        $mailer ->send($msg);
                    }
                }
                
                
            }
          }catch (Exception $ex) 
          {
            try
            {
                file_put_contents(sfConfig::get('sf_log_dir')."/email_activation.log", $ex->getMessage());
            }catch(Exception $ex) {}
          }
          
          $this->sendOrderPayAlert($member, $subscription);
          $result = 1;
      }
      
      if($request->isXmlHttpRequest())
      {
          $this->renderText("".$result);
          return sfView::NONE;
      }
      
      $this->redirect(array('sf_route' => 'member_edit', 'sf_subject' => $member));
  }
  
  public function executeOrderEmail(sfWebRequest $request)
  {
      $member = $this->getRoute()->getObject();
      
      $subscription = member_subscriptionTable::getInstance() 
                        ->createQuery('ms')
                        ->addWhere('ms.member_id = ?', $member->getId())
                        ->orderBy('ms.id desc')
                        ->fetchOne();
      
      $sent = $this->sendOrderPayAlert($member, $subscription);
	  $this->renderText('Sent '.$sent.' emails.');
      return sfView::NONE;
  }
  
  /**
   * Sends Order Payment Received Email Alert
   * @param member $member
   * @param member_subscription $subscription
   */
  private function sendOrderPayAlert($member, $subscription)
  {
      try
        {
            /* @var $subscription member_subscription */
          $sub_id = $subscription->getSubscriptionId();

          $products = productTable::getInstance()                 
                              ->createQuery('pr')
                              ->select('pr.name as product_name')                              
                              ->innerJoin('pr.subscription_product sp')                              
                              ->addWhere('sp.subscription_id = ?', $sub_id)
                              ->fetchArray();                   
          
          $order_no = $subscription->getSubscriptionId().$subscription->getId().$member->getId();
          
          $amount = $subscription->getPrice();
          
          $m_coupon = $subscription->getMemberCoupon();
          if($m_coupon)
          {
               $coupon = $m_coupon->getCoupon();
               if( ($discount = $coupon->getDiscountRate()) )
                {
                    $amount -= $discount;
                }
          }
            
          $amount = $subscription->getSubscription()->getCurrency()." ".$amount;
          
          $email_body =  $this->getPartial("email_order_complete_customer", array("user"=>$member,"order_no"=>$order_no,"products"=>$products,"amount"=>$amount));

          $msg = $this->getMailer()->compose();
          $msg->setSubject("Payment Received for Order #".$order_no);
          $msg->addFrom("nriservices@groworth.in","Groworth Real Solutions Pvt. Ltd");
          $msg->addReplyTo("nrihelp@groworth.in", "Groworth Real Solutions Pvt. Ltd");
          $msg->addTo($member->getEmailAddress() , $member->getFirstName() );            
          $msg->setBody($email_body, 'text/html', "utf-8");
          $this->getMailer()->sendNextImmediately();
          $this->getMailer()->send($msg);

          $msg = $this->getMailer()->compose();
          $msg->setSubject("Payment Received for Order #".$order_no);
          $msg->addFrom("nriservices@groworth.in","Groworth Real Solutions Pvt. Ltd");
          $msg->addReplyTo("nrihelp@groworth.in", "Groworth Real Solutions Pvt. Ltd");
          $msg->addTo("sandeep.groworth@gmail.com","Sandeep Ghadge");    
          $msg->addTo("mrugendrabhure@gmail.com","Mrugendra Bhure" );            
          $msg->setBody($email_body, 'text/html', "utf-8");

          $this->getMailer()->sendNextImmediately();
          return $this->getMailer()->send($msg);

        } catch (Exception $ex) 
        {
           $this->renderText($ex->getMessage());     
        }       
		return 0;
  }

  public function executeExportPdf(sfWebRequest $request)
  {

      //$members = Doctrine::getTable('member')->findAll();
      $query = $this->buildQuery();
      $members  = $query->execute();

      $html_body = $this->getPartial("asHtml" , array("members" => $members));

      $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

      // set document information
      $pdf->SetCreator(PDF_CREATOR);
      $pdf->SetAuthor('Groworth.in');
      //$pdf->SetTitle('TCPDF Example 006');
      $pdf->SetSubject('Groworth Member');
      //$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

      // set default header data
      //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);
      //$pdf->setHeaderData($ln, $lw, $ht, $hs);
      // set header and footer fonts
      //$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
      //$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

      // set default monospaced font
      $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

      //set margins

      $pdf->SetMargins(8, 0, 4);
      $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
      $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

      //set auto page breaks
      $pdf->SetAutoPageBreak(TRUE, 2);

      //set image scale factor
      $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

      //set some language-dependent strings
      //$pdf->setLanguageArray($l);

      $pdf->setPrintHeader(false);
      $pdf->setPrintFooter(false);

      // ---------------------------------------------------------        
      // set font

      $pdf->SetFont('helvetica', '', 10);
      // add a page
      $pdf->AddPage();        

      $pdf->writeHTML($html_body, false, false, true, false, '');

      $path = "Memberlist.pdf";
      $response = $this->getResponse();
      $response->setContentType('application/pdf');
      $response->setHttpHeader('Content-Disposition', 'attachment; filename="' . $path . '"');
      $this->setLayout(false);

      /* @var $itr_submission itr_submission */
      
      $pwd = "member";
      $pdf->SetProtection(array('print', 'copy'), $pwd, null, 0, null);
      $pdf->Output($path, 'D');
      //$pdf->Output($path);
  }
  
}
