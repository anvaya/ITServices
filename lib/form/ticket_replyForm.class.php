<?php

/**
 * ticket_comment form.
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ticket_replyForm extends Baseticket_commentForm
{
  public function configure()
  {
      unset($this['private_message']);
      $this->widgetSchema['ticket_id'] = new sfWidgetFormInputHidden(array(),array('value'=>$this->getOption('ticket_id')));
      $this->widgetSchema['replied_by'] = new sfWidgetFormInputHidden();
      $this->widgetSchema['public_message'] = new sfWidgetFormTextarea(array('label'=> 'Message'));
      $this->validatorSchema['public_message'] = new sfValidatorString(array('required' => true, 'max_length' => '3000'));
      //$this->widgetSchema['private_message']= new sfWidgetFormTextarea();
      //$this->widgetSchema['ticket_id'] = new sfWidgetFormInputHidden();
            
      unset($this['created_at'], $this['updated_at'], $this['alert_sent'], $this['sent_to_customer'],$this['is_reply'],$this['replied_by']);
      
  }
}
