<?php

/**
 * support_ticket filter form.
 *
 * @package    BestBuddies
 * @subpackage filter
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class support_ticketFormFilter extends Basesupport_ticketFormFilter
{
  public function configure()
  {
      $date_widget = new sfWidgetFormDate(array('format'=>'%day%/%month%/%year%'));
      $date_config = array('config'=>'{dateFormat: "dd/MMM/yy"}','date_widget'=>$date_widget );            
      
      $this->widgetSchema['date_received'] = new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormJQueryDate($date_config) , 'to_date' => new sfWidgetFormJQueryDate($date_config) ));                 
      $this->widgetSchema['status'] = new sfWidgetFormChoice(array("choices"=>  support_ticketForm::$ticket_states));
      $this->validatorSchema['status'] = new sfValidatorChoice(array("choices"=>array_keys(support_ticketForm::$ticket_states),"required"=>false));
      
      $this->widgetSchema['member_id']->setOption("order_by", array("username","asc") );
  }
  
  public function getFields()
  {
    return array(
      'id'            => 'Text',
      'tracking_no'   => 'Text',
      'member_id'    => 'ForeignKey',
      'created_by'    => 'ForeignKey',
      'date_received' => 'Date',
      'status'        => 'ForeignKey',
      'assigned_to'   => 'ForeignKey',
    );
  }
}
