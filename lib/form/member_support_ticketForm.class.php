<?php

/**
 * support_ticket form.
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class member_support_ticketForm extends Basesupport_ticketForm
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
      $this->widgetSchema['date_received']= new sfWidgetFormInputHidden();
      $this->validatorSchema['date_received'] = new sfValidatorPass();
            
      
      $this->widgetSchema['created_by'] = new sfWidgetFormInputHidden();
      $this->widgetSchema['member_id'] = new sfWidgetFormInputHidden(array(),array('value'=>  sfContext::getInstance()->getUser()->getAttribute('user_id', null, 'sfGuardSecurityUser')));
      $this->widgetSchema['assigned_to'] = new sfWidgetFormInputHidden(array(),array('value' => 1));
      
      $this->widgetSchema['ticket_subject'] = new sfWidgetFormInputText(array('label'=>'Subject'), array('size'=>80));
      $this->validatorSchema['ticket_subject'] = new sfValidatorString(array('required' => true, 'max_length' => '255'));
      
      //$this->widgetSchema['status'] = new sfWidgetFormChoice(array("choices"=>self::$ticket_states));
      //$this->validatorSchema['status'] = new sfValidatorChoice(array("choices"=>array_keys(self::$ticket_states),"required"=>false));
      $this->widgetSchema['status'] = new  sfWidgetFormInputHidden(array(), array('value'=>1));
              
      //$this->setDefault('status', support_ticketTable::STATUS_OPEN);
      
      $this->widgetSchema['tracking_no'] = new sfWidgetFormInputHidden();
      $this->validatorSchema['tracking_no'] = new sfValidatorPass();
      $this->setDefault('tracking_no', "[Auto on Save]");
      
      $this->setDefault('date_received',date('Y-m-d H:i:s'));
      
      //$this->widgetSchema['member_id']->setOption("order_by", array("username","asc") );
      //$ticketcommentForm = new ticketCommentCollectionForm(null, array("support_ticket" => $this->getObject()));
      //$this->embedForm("ticket_comments", $ticketcommentForm);

      //if($this->isNew)
      {
        $subForm = new sfForm();
        //$subForm->disableLabels();        
        $ticket_comment = new ticket_comment();
        $ticket_comment->support_ticket = $this->getObject();
        $form = new member_ticket_commentForm($ticket_comment);
        $subForm->embedForm(0, $form);
        $this->embedForm('comments', $subForm);
      }/*else
        $this->embedRelation('ticket_comment');*/
      
      // add a post validator
      $this->validatorSchema->setPostValidator(
        new sfValidatorCallback(array('callback' => array($this, 'checkemail')))
      );     
   
      
      $this->widgetSchema['department_id'] = new sfWidgetFormInputHidden();
      $this->widgetSchema['product_id'] = new sfWidgetFormInputHidden();
      
      $this->validatorSchema['department_id']->setOption('required', false);   
      
  }
  
  public function checkemail($validator, $values)
  {
    //echo sfContext::getInstance()->getUser()->getGuardUser()->getEmailAddress();exit;
    $values['sender_email'] = sfContext::getInstance()->getUser()->getGuardUser()->getEmailAddress();
 
    // password is correct, return the clean values
    return $values;
  }  
}
