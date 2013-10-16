<?php

/**
 * member_type form.
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class member_typeForm extends Basemember_typeForm
{
  public function configure()
  {
      $this->widgetSchema['description'] = new sfWidgetFormTextarea();
  }
}
