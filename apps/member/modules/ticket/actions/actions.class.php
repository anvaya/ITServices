<?php

require_once dirname(__FILE__).'/../lib/ticketGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/ticketGeneratorHelper.class.php';

/**
 * ticket actions.
 *
 * @package    BestBuddies
 * @subpackage ticket
 * @author     Anvaya Technologies
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ticketActions extends autoTicketActions
{
  public function executeSendReply(sfWebRequest $request)
  {
    $this->support_ticket = Doctrine::getTable('support_ticket')->find($request->getParameter('id'));
    
    if(!$this->support_ticket || $this->support_ticket->getMemberId() != $this->getUser()->getAttribute('user_id',null,'sfGuardSecurityUser'))
      return $this->redirect('@support_ticket');
    
    $this->form = new ticket_replyForm(null,array('ticket_id' => $request->getParameter('id')));
    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getParameter('ticket_comment'));
      if ($this->form->isValid())
      {
        $arr_form = $this->form->getValues();               

        //$this->form-save();
        /* @var $ticket_comment ticket_comment */
        $ticket_comment = new ticket_comment();
        $ticket_comment->setTicketId($arr_form['ticket_id']);
        $ticket_comment->setPublicMessage($arr_form['public_message']);        
        $ticket_comment->save();

        $this->getUser()->setFlash('notice', 'The reply was sent successfully.');
        $this->redirect('@support_ticket');
      }  else {
        $this->getUser()->setFlash('error', 'The reply has not been sent due to some errors.', false);
      }
    }
  }
  
  public function executeShow(sfWebRequest $request)
  {
      $this->ticket = $this->getRoute()->getObject();
  }
  
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'Your query has been sent successfully.' : 'The item was updated successfully.';

      try {
        $support_ticket = $form->save();
      } catch (Doctrine_Validator_Exception $e) {

        $errorStack = $form->getObject()->getErrorStack();

        $message = get_class($form->getObject()) . ' has ' . count($errorStack) . " field" . (count($errorStack) > 1 ?  's' : null) . " with validation errors: ";
        foreach ($errorStack as $field => $errors) {
            $message .= "$field (" . implode(", ", $errors) . "), ";
        }
        $message = trim($message, ', ');

        $this->getUser()->setFlash('error', $message);
        return sfView::SUCCESS;
      }

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $support_ticket)));

      $this->getUser()->setFlash('notice', $notice);

      $this->redirect("@support_ticket");      
    }
    else
    {
      $this->getUser()->setFlash('error', 'The query could not be sent due to some errors.', false);
    }
  }
  
}
