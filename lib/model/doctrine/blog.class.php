<?php

/**
 * blog
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    BestBuddies
 * @subpackage model
 * @author     Anvaya Technologies
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class blog extends Baseblog
{
    public function getStatusName()
    {
        if($this->getStatus())
        {
            return blogTable::$status_choices[$this->getStatus()];
        }
        
        return blogTable::$status_choices[blogTable::STATUS_DRAFT];
    }
}