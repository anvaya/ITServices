<?php

/**
 * faq actions.
 *
 * @package    DemegaDropShip
 * @subpackage faq
 * @author     Mrugendra Bhure
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class faqActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
     $table = Doctrine::getTable('faq');
     $query = $table->createQuery('q');
     $this->faqs = $table->retrieveActive($query)->execute();
  } 
  
}
