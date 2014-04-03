<?php

/**
 * support_ticket form.
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class support_ticketForm extends Basesupport_ticketForm
{
   static $ticket_states = array(
       ""=>"",
       support_ticketTable::STATUS_OPEN=>"Open",
       support_ticketTable::STATUS_AWAITING_REPLY=>"Awaiting Customer Reply",
       support_ticketTable::STATUS_CLOSED=>'Closed',
       support_ticketTable::STATUS_CLOSED_REPAIR_CREATED=>'Closed. Support Ticket Created'
   );
     
  public function configure()
  {      
      $date_widget = new sfWidgetFormDate(array('format'=>'%day%/%month%/%year%'));
      $date_config = array('config'=>'{dateFormat: "dd/MMM/yy"}','date_widget'=>$date_widget );            
      
      $this->widgetSchema['date_received'] = new sfWidgetFormJQueryDate($date_config);    
      
      $this->widgetSchema['created_by'] = new sfWidgetFormInputHidden();
      
      $this->widgetSchema['status'] = new sfWidgetFormChoice(array("choices"=>self::$ticket_states));
      $this->validatorSchema['status'] = new sfValidatorChoice(array("choices"=>array_keys(self::$ticket_states),"required"=>false));

      $this->widgetSchema['date_received']->setDefault(date('d-m-Y'));
      $this->setDefault('status', support_ticketTable::STATUS_OPEN);
      
      $this->validatorSchema['tracking_no'] = new sfValidatorPass();
      $this->setDefault('tracking_no', "[Auto on Save]");
      
      
      $this->widgetSchema['member_id']->setOption("order_by", array("username","asc") );                  
      
      $query = sfGuardUserTable::getInstance()
                ->createQuery('su')
                ->select('su.id, su.first_name, su.last_name, su.username')
                ->addWhere('(su.is_member is NULL or su.is_member = 0)')
                ->orderBy('su.first_name');
      
      $this->widgetSchema['assigned_to']->setOption('query', $query);
              
  }
}
