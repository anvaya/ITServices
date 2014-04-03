<?php

/**
 * ticket_comment form.
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class member_ticket_commentForm extends Baseticket_commentForm
{
  public function configure()
  {
      unset($this['ticket_id'],$this['private_message']);
      $this->widgetSchema['replied_by'] = new sfWidgetFormInputHidden();
      $this->widgetSchema['public_message'] = new sfWidgetFormTextarea(array('label'=> 'Message'));
      $this->validatorSchema['public_message'] = new sfValidatorString(array('required' => true, 'max_length' => '3000'));
      //$this->widgetSchema['private_message']= new sfWidgetFormTextarea();
      //$this->widgetSchema['ticket_id'] = new sfWidgetFormInputHidden();
            
      unset($this['created_at'], $this['updated_at'], $this['alert_sent'], $this['sent_to_customer'],$this['is_reply']);

      /*if($this->isNew)
      {
        $subForm = new sfForm();
        $ticket_file = new ticket_file();
        $ticket_file->ticket_comment = $this->getObject();
        $form = new member_ticket_fileForm($ticket_file);
        $subForm->embedForm(0, $form);
        $this->embedForm('newticket_file', $subForm);
      }else
      {
        $this->embedRelation('ticket_file');
      }*/
      
  }
}
