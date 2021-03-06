<?php

/**
 * orderTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class orderTable extends Doctrine_Table
{
    const ORDER_STATUS_PENDING      = 1;
    const ORDER_STATUS_PAYMENT_SENT = 2;
    const ORDER_STATUS_PAID         = 3;
    const ORDER_STATUS_CANCELLED         = 4;
    
    static $ORDER_STATUS_CHOICES = array
            (
                self::ORDER_STATUS_PENDING => "Pending",
                self::ORDER_STATUS_PAYMENT_SENT => "Payment Sent by Customer",
                self::ORDER_STATUS_PAID => "Payment Received",
                self::ORDER_STATUS_CANCELLED => "Cancelled",
            );
    
    static $ORDER_STATUS_CHOICES_WITH_EMPTY = array
            (
                "" => "Any",
                self::ORDER_STATUS_PENDING => "Pending",
                self::ORDER_STATUS_PAYMENT_SENT => "Payment Sent by Customer",
                self::ORDER_STATUS_PAID => "Payment Received",
                self::ORDER_STATUS_CANCELLED => "Cancelled",
            );
    
    /**
     * Returns an instance of this class.
     *
     * @return object orderTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('order');
    }
}