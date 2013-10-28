<?php

/**
 * settings form.
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class settingsForm extends BasesettingsForm
{
  public function configure()
  {
    unset($this['created_at'],$this['updated_at'],$this['description']);
    //$this->widgetSchema['description'] = new sfWidgetFormTextarea();
  }
}
