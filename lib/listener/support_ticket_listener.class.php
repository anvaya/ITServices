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
}

?>