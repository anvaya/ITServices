<?php

require_once dirname(__FILE__).'/../lib/profileGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/profileGeneratorHelper.class.php';

/**
 * profile actions.
 *
 * @package    BestBuddies
 * @subpackage profile
 * @author     Anvaya Technologies
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class profileActions extends autoProfileActions
{
    public function executeIndex(sfWebRequest $request)
    {
        $sf_user = $this->getUser()->getGuardUser();
        /* @var $sf_user sfGuardUser */
        $request->setParameter("id", $sf_user->getId());
        
        $this->redirect("@member_edit?id=".$sf_user->getId());
    }
}
