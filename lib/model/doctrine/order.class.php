<?php

/**
 * order
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    BestBuddies
 * @subpackage model
 * @author     Anvaya Technologies
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class order extends Baseorder
{
    public function getStatusName()
    {
        $status = $this->getStatus();
        
        if(!$status)
            return "Pending";            
        
        if(isset(orderTable::$ORDER_STATUS_CHOICES[$status]))
        {
            return orderTable::$ORDER_STATUS_CHOICES[$status];
        }
        else
        {
            return "Pending";
        }
    }
}