<?php

/**
 * paymentTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class paymentTable extends Doctrine_Table
{
    const STATUS_BANK_PAYMENT = 1;
    /**
     * Returns an instance of this class.
     *
     * @return object paymentTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('payment');
    }
}