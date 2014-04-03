<?php

/**
 * ticket module helper.
 *
 * @package    BestBuddies
 * @subpackage ticket
 * @author     Anvaya Technologies
 * @version    SVN: $Id: helper.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ticketGeneratorHelper extends BaseTicketGeneratorHelper
{
  public function linkToSave($object, $params)
  {
    return '<li class="sf_admin_action_save"><input class="green-btn" type="submit" value="'.__($params['label'], array(), 'sf_admin').'" /></li>';
  }
  
  public function linkToList($params)
  {
    $background ="background: #dfeffc url(". public_path('css/redmond/images/ui-bg_glass_85_dfeffc_1x400.png)')." 50% 50% repeat-x";  
    return '<li class="sf_admin_action_list">'.link_to('<span class="ui-icon ui-icon-arrowreturnthick-1-w"></span>'. __($params['label'], array(), 'sf_admin'), '@'.$this->getUrlForAction('list'),array('class'=>'fg-button ui-state-default fg-button-icon-left','style'=>$background)).'</li>';
  }
}
