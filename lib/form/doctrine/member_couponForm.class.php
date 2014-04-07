<?php

/**
 * member_coupon form.
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class member_couponForm extends Basemember_couponForm
{
  public function configure()
  {
    unset($this['updated_at'],$this['created_at']);
  }
}
