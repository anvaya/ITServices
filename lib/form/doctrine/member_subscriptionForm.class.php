<?php

/**
 * member_subscription form.
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class member_subscriptionForm extends Basemember_subscriptionForm
{
  public function configure()
  {      
      unset($this['itr_product_id']);
  }
}
