<?php
include sfConfig::get('sf_lib_dir')."/vendor/anvaya/util.php";
/**
 * default actions.
 *
 * @package    BestBuddies
 * @subpackage default
 * @author     Anvaya Technologies
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class defaultActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
      #die(urlencode($data));
      $member_id = $this->getUser()->getGuardUser()->getId();
  
      $member = memberTable::getInstance()->find($member_id);
      /* @var $member member */      
      $this->member = $member;
      
      $subscription = $member->getCurrentActiveSubscription();     
          
      $current_subscription = subscriptionTable::getInstance()   
                                ->createQuery('st')
                                ->addWhere('st.id > ?', $subscription->getSubscription()->getId())
                                ->orderBy('st.id desc')
                                ->fetchOne();
      
      $this->current_subscription = $current_subscription;
      
      /* @var $subscription member_subscription */
      $this->show_itr_selection =  (!$subscription->getItrProductId());
      
      $this->itr_products = productTable::getInstance()
                        ->createQuery('p')
                        ->addWhere('p.category_id = ?', product_categoryTable::CATEGORY_ITR)
                        ->addWhere('p.expired is null or p.expired = 0')
                        ->fetchArray();                        
  }
  
  public function executeKeepAlive(sfWebRequest $request)
  {
      $this->renderText("1");
      return sfView::NONE;
  }   
  
  public function executeMemberId(sfWebRequest $request)
  {
      $this->renderText("".$this->getUser()->getGuardUser()->getId());
      return sfView::NONE;
  }
}
