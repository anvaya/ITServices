<?php

require_once dirname(__FILE__).'/../lib/memberGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/memberGeneratorHelper.class.php';

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
}
