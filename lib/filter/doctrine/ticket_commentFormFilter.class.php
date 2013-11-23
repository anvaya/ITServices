<?php

/**
 * ticket_comment filter form.
 *
 * @package    BestBuddies
 * @subpackage filter
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ticket_commentFormFilter extends Baseticket_commentFormFilter
{
  public function configure()
  {
      $this->widgetSchema['replied_by'] = new sfWidgetFormInputHidden();
      $this->widgetSchema['is_reply']   = new sfWidgetFormInputHidden();
      $this->widgetSchema['public_message'] = new sfWidgetFormTextarea();
      $this->widgetSchema['private_message']= new sfWidgetFormTextarea();
      
      $this->widgetSchema['ticket_id'] = new sfWidgetFormInputHidden();
            
      unset($this['created_at'], $this['updated_at'], $this['alert_sent'], $this['sent_to_customer']);
  }
}
