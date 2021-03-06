<?php

/**
 * Basesubscription_product
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $subscription_id
 * @property integer $product_id
 * @property integer $units
 * @property subscription $subscription
 * @property product $product
 * 
 * @method integer              getId()              Returns the current record's "id" value
 * @method integer              getSubscriptionId()  Returns the current record's "subscription_id" value
 * @method integer              getProductId()       Returns the current record's "product_id" value
 * @method integer              getUnits()           Returns the current record's "units" value
 * @method subscription         getSubscription()    Returns the current record's "subscription" value
 * @method product              getProduct()         Returns the current record's "product" value
 * @method subscription_product setId()              Sets the current record's "id" value
 * @method subscription_product setSubscriptionId()  Sets the current record's "subscription_id" value
 * @method subscription_product setProductId()       Sets the current record's "product_id" value
 * @method subscription_product setUnits()           Sets the current record's "units" value
 * @method subscription_product setSubscription()    Sets the current record's "subscription" value
 * @method subscription_product setProduct()         Sets the current record's "product" value
 * 
 * @package    BestBuddies
 * @subpackage model
 * @author     Anvaya Technologies
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Basesubscription_product extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('subscription_product');
        $this->hasColumn('id', 'integer', 5, array(
             'type' => 'integer',
             'size' => 5,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => true,
             'length' => 5,
             ));
        $this->hasColumn('subscription_id', 'integer', 5, array(
             'type' => 'integer',
             'size' => 5,
             'notnull' => true,
             'unsigned' => true,
             'length' => 5,
             ));
        $this->hasColumn('product_id', 'integer', 5, array(
             'type' => 'integer',
             'size' => 5,
             'notnull' => true,
             'unsigned' => true,
             'length' => 5,
             ));
        $this->hasColumn('units', 'integer', 4, array(
             'type' => 'integer',
             'size' => 4,
             'notnull' => false,
             'length' => 4,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('subscription', array(
             'local' => 'subscription_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE',
             'onUpdate' => 'CASCADE'));

        $this->hasOne('product', array(
             'local' => 'product_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE',
             'onUpdate' => 'CASCADE'));
    }
}