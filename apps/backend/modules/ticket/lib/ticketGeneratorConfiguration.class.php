<?php

/**
 * ticket module configuration.
 *
 * @package    SupportDB
 * @subpackage ticket
 * @author     Anvaya Technologies
 * @version    SVN: $Id: configuration.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ticketGeneratorConfiguration extends BaseTicketGeneratorConfiguration
{
    public function getFilterDefaults()
    {
        $guard_user = sfContext::getInstance()->getUser()->getGuardUser();
        /* @var $guard_user sfGuardUser */
        if($guard_user->hasGroup("Engineers"))
        {            
            return array("assigned_to"=>$guard_user->getId());
        }
        
        return array();
    }
}
