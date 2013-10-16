<?php

/**
 * profile module helper.
 *
 * @package    BestBuddies
 * @subpackage profile
 * @author     Anvaya Technologies
 * @version    SVN: $Id: helper.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class profileGeneratorHelper extends BaseProfileGeneratorHelper
{
    public function linkToSave($object, $params)
  {
    return '<li class="sf_admin_action_save"><input class="purple-btn" type="submit" value="'.__($params['label'], array(), 'sf_admin').'" /></li>';
  }
}
