<?php

/**
 * family_contactTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class family_contactTable extends contactTable
{
    /**
     * Returns an instance of this class.
     *
     * @return object family_contactTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('family_contact');
    }
}