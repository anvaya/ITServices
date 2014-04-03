<?php

/**
 * itr module configuration.
 *
 * @package    BestBuddies
 * @subpackage itr
 * @author     Anvaya Technologies
 * @version    SVN: $Id: configuration.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class itrGeneratorConfiguration extends BaseItrGeneratorConfiguration
{
    public function getFormClass() {
        return "backendItrSubmissionForm";
    }
}
