<?php

/**
 * memberTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class memberTable extends sfGuardUserTable
{
    /**
     * Returns an instance of this class.
     *
     * @return object memberTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('member');
    }
}