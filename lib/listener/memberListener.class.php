<?php
/**
 * Description of memberListener
 *
 * @author Mrugendra Bhure
 */
class memberListener extends Doctrine_Record_Listener
{   
    public function postSave(Doctrine_Event $event) 
    {
        parent::postSave($event);
        $record = $event->getInvoker();
        
        
        
    }    
}

?>