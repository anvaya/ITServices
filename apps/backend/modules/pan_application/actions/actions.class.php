<?php

require_once dirname(__FILE__).'/../lib/pan_applicationGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/pan_applicationGeneratorHelper.class.php';

/**
 * pan_application actions.
 *
 * @package    BestBuddies
 * @subpackage pan_application
 * @author     Anvaya Technologies
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class pan_applicationActions extends autoPan_applicationActions
{
  /*protected function setFilters(array $filters)
  {
    if(array_key_exists('status', $filters))
      $filters['status'] = array('text'=> $filters['status']);
    return $this->getUser()->setAttribute('pan_application.filters', $filters, 'admin_module');
  }*/
  
}
