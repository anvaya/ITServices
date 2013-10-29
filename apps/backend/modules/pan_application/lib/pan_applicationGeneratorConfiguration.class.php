<?php

/**
 * pan_application module configuration.
 *
 * @package    BestBuddies
 * @subpackage pan_application
 * @author     Anvaya Technologies
 * @version    SVN: $Id: configuration.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class pan_applicationGeneratorConfiguration extends BasePan_applicationGeneratorConfiguration
{
  public function getFilterDefaults()
  {
    return array( "status" => array("operator" => "EQ", "value" => 2, "field_type" => "foreign"));
    //return array("status"=>2);
  }
}
