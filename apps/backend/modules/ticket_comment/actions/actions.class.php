<?php

require_once dirname(__FILE__).'/../lib/ticket_commentGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/ticket_commentGeneratorHelper.class.php';
require_once sfConfig::get('sf_lib_dir')."/vendor/anvaya/util.php";
/**
 * ticket_comment actions.
 *
 * @package    SupportDB
 * @subpackage ticket_comment
 * @author     Anvaya Technologies
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ticket_commentActions extends autoTicket_commentActions
{
  public function executeNew(sfWebRequest $request)
  {
    $this->form = $this->configuration->getForm();
    $this->ticket_comment = $this->form->getObject();
    if($request->hasParameter('ticket_id'))
    {
       $this->form->setDefault('ticket_id', $request->getParameter('ticket_id') );
       $ticket = Doctrine::getTable('support_ticket')
                ->find($request->getParameter('ticket_id'));
       
       /* @var $ticket support_ticket */
       if($ticket->getTicketComment()->count() > 0)
       {
            $this->form->setDefault('replied_by', $this->getUser()->getGuardUser()->getId() );
            $this->form->setDefault('is_reply', 1 );
       }       
    }
    else 
    {
        $this->forward404();
    }    
    
    
    $this->setLayout('popup');
  }
  
  public function executeCustomerAlert(sfWebRequest $request)
  {
      $this->ticket_comment = $this->getRoute()->getObject();
      $this->setLayout('email');
  }
  
  public function executeClose(sfWebRequest $request)
  {
      
  }
  
  public function executeFile(sfWebRequest $request)
  {
      
      $this->forward404Unless($request->hasParameter('file_id'));
      
      $file_id = $request->getParameter('file_id');
      $comment = $this->getRoute()->getObject();
      $file    = Doctrine::getTable('ticket_file')
                ->findOneByIdAndCommentId($file_id, $comment->getId());
      
      if(!$file)
          $this->forward404();
      else
      {
          $name = $file->getFileName();
          $file_path = sfConfig::get('sf_data_dir')."/ticket_files/".$name;
          if(file_exists($file_path))
          {
              $response = $this->getResponse();
              
             /* @var $response sfWebResponse */
             if(function_exists("mime_content_type"))
                $response->setContentType(mime_content_type($file_path));
             elseif(function_exists('finfo_open'))
             {
                $finfo = finfo_open(FILEINFO_MIME);                 
                $response->setContentType(mime_content_type(finfo_file($finfo, $file_path)));
             }
             
             #$response->setHttpHeader('Content-Disposition','attachment; filename="'.$name.'"');
             //$file_path = sfConfig::get('sf_root_dir')."/files/workbook/".$file_name;
             $response->setContent(file_get_contents($file_path));
             return sfView::NONE; 
          }
          else
            $this->forward404();
      }
  }
  
  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

      try {
        $ticket_comment = $form->save();
        
        /* @var $ticket_comment ticket_comment */
        if( (!$ticket_comment->getSentToCustomer()) && $ticket_comment->getIsReply() )
        {
            $result = $this->sendCustomerAlert($ticket_comment);
            if($result)
            {
                $ticket_comment->setSentToCustomer(true);
                $ticket_comment->save();
            }
        }
        elseif( (!$ticket_comment->getIsReply()) && (!$ticket_comment->getAlertSent()) )
        {
            $assigned = $ticket_comment->getSupportTicket()->getAssignedToUser();
            if($assigned)
            {
               $result = $this->sendUserAlert($ticket_comment, $assigned);
               if($result)
               {
                   $ticket_comment->setAlertSent(true);
                   $ticket_comment->save();
               }
            }
        }
        
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

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $ticket_comment)));
     
           
      $this->getUser()->setFlash('notice', $notice);

      $this->redirect(array('sf_route' => 'ticket_comment_close', 'sf_subject' => $ticket_comment));      
      
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }
  
  private function sendCustomerAlert(ticket_comment $ticket_comment)
  {
      try
      {
          $member  = $ticket_comment->getSupportTicket()->getMember();
          
        if( strlen($ticket_comment->getSupportTicket()->getSenderEmail()) == 0 )
        {
            $to_email = $ticket_comment->getSupportTicket()->getSenderEmail();
        }
        elseif($company) 
        {
            $customer   = $member->getEmailAddress();
            $to_email   = $member->getEmailAddress();
            $to_name    = $member->getFirstName()." ".$member->getLastName();
        }
        else
            return false;
        
        $subject    = "[ticket #". $ticket_comment->getSupportTicket()->getTrackingNo()."]";
        
        $message = $this->getController()->getPresentationFor("ticket_comment", "customerAlert");
        
        return send_email($to_name, $to_email, $subject, $message);
        
      }catch(Exception $ex) { return false; }
  }
  
  private function sendUserAlert(ticket_comment $ticket_comment, sfGuardUser $user)          
  {
      try
      {
        $to_email = $user->getEmailAddress();
        $to_name  = $user->getFirstName()." ".$user->getLastName();

        $subject = "New Ticket #".$ticket_comment->getRepairTicket()->getTrackingNo();
        $message = $this->getPartial("ticket_comment/user_alert", array("ticket_comment"=>$ticket_comment, "user"=>$user) );
        
        return send_email($to_name, $to_email, $subject, $message);
      }catch(Exception $ex)
      {
          return false;
      }
  }
}
