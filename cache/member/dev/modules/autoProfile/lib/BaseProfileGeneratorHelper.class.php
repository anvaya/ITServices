<?php

/**
 * profile module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage profile
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: helper.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseProfileGeneratorHelper extends sfModelGeneratorHelper
{
  public function getUrlForAction($action)
  {
    return 'list' == $action ? 'member' : 'member_'.$action;
  }
}
