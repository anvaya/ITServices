<?php
/**
 * Description of support_ticket_listener
 *
 * @author Mrugendra Bhure
 */
class support_ticket_listener extends Doctrine_Record_Listener
{
    public function preInsert(Doctrine_Event $event) 
    {        
        parent::preInsert($event);
        $record = $event->getInvoker();
        /* @var $record support_ticket */
        $record->setTrackingNo(uniqid("T"));
    }
    
    public function postInsert(Doctrine_Event $event) 
    {
        parent::postInsert($event);
        $record = $event->getInvoker();
        /* @var $record support_ticket */
        try 
        {                        
            //if(!$record->getAssignedTo())
            {
                $user = $record->getMember();
                $member_name = $user->getLastName()." ".$user->getFirstName();
                $body = "Hi,\n\n".
                        "Member ".$member_name." just created a support ticket\n\n".
                        "Subject: ".$record->getTicketSubject()."\n\n".
                        "Please log into administration for details and reply. \n\n".
                        "Groworth Real Solutions";
                
                $mailer = sfContext::getInstance()->getMailer();
                $msg = $mailer->compose();
                $msg->setSubject("Support Ticket Created By Member");
                $msg->addFrom("nriservices@groworth.in","Groworth Real Solutions Pvt. Ltd");
                $msg->addReplyTo("".$user->getEmailAddress(), $member_name);
                $msg->addTo("sandeep.groworth@gmail.com","Sandeep Ghadge");
                $msg->addTo("ca.ajayvaswani@gmail.com","Ajay Vaswani");
                $msg->addTo("ashish.shahu.1986@gmail.com","Ashish Shahu");
                $msg->addCc("mrugendrabhure@gmail.com", "Mrugendra Bhure");
                $msg->setBody($body, 'text/plain', "utf-8");
                
                $mailer->sendNextImmediately();
                $mailer->send($msg);
            }
        } catch (Exception $ex) 
        {
            
        }
    }
}

?>