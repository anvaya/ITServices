<?php

/**
 * Baseproduct
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property string $description
 * @property integer $category_id
 * @property date $expiry_date
 * @property boolean $expired
 * @property integer $billing_unit
 * @property integer $form_id
 * @property decimal $price
 * @property string $template
 * @property billing_unit $billing_unit
 * @property product_category $product_category
 * @property submission_form $submission_form
 * @property Doctrine_Collection $support_ticket
 * @property Doctrine_Collection $subscription_product
 * @property Doctrine_Collection $product_usage
 * 
 * @method integer             getId()                   Returns the current record's "id" value
 * @method string              getCode()                 Returns the current record's "code" value
 * @method string              getName()                 Returns the current record's "name" value
 * @method string              getDescription()          Returns the current record's "description" value
 * @method integer             getCategoryId()           Returns the current record's "category_id" value
 * @method date                getExpiryDate()           Returns the current record's "expiry_date" value
 * @method boolean             getExpired()              Returns the current record's "expired" value
 * @method billing_unit        getBillingUnit()          Returns the current record's "billing_unit" value
 * @method integer             getFormId()               Returns the current record's "form_id" value
 * @method decimal             getPrice()                Returns the current record's "price" value
 * @method string              getTemplate()             Returns the current record's "template" value
 * @method product_category    getProductCategory()      Returns the current record's "product_category" value
 * @method submission_form     getSubmissionForm()       Returns the current record's "submission_form" value
 * @method Doctrine_Collection getSupportTicket()        Returns the current record's "support_ticket" collection
 * @method Doctrine_Collection getSubscriptionProduct()  Returns the current record's "subscription_product" collection
 * @method Doctrine_Collection getProductUsage()         Returns the current record's "product_usage" collection
 * @method product             setId()                   Sets the current record's "id" value
 * @method product             setCode()                 Sets the current record's "code" value
 * @method product             setName()                 Sets the current record's "name" value
 * @method product             setDescription()          Sets the current record's "description" value
 * @method product             setCategoryId()           Sets the current record's "category_id" value
 * @method product             setExpiryDate()           Sets the current record's "expiry_date" value
 * @method product             setExpired()              Sets the current record's "expired" value
 * @method product             setBillingUnit()          Sets the current record's "billing_unit" value
 * @method product             setFormId()               Sets the current record's "form_id" value
 * @method product             setPrice()                Sets the current record's "price" value
 * @method product             setTemplate()             Sets the current record's "template" value
 * @method product             setProductCategory()      Sets the current record's "product_category" value
 * @method product             setSubmissionForm()       Sets the current record's "submission_form" value
 * @method product             setSupportTicket()        Sets the current record's "support_ticket" collection
 * @method product             setSubscriptionProduct()  Sets the current record's "subscription_product" collection
 * @method product             setProductUsage()         Sets the current record's "product_usage" collection
 * 
 * @package    BestBuddies
 * @subpackage model
 * @author     Anvaya Technologies
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Baseproduct extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('product');
        $this->hasColumn('id', 'integer', 5, array(
             'type' => 'integer',
             'size' => 5,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => true,
             'length' => 5,
             ));
        $this->hasColumn('code', 'string', 10, array(
             'type' => 'string',
             'size' => 10,
             'notnull' => false,
             'length' => 10,
             ));
        $this->hasColumn('name', 'string', 200, array(
             'type' => 'string',
             'size' => 200,
             'notnull' => false,
             'length' => 200,
             ));
        $this->hasColumn('description', 'string', 1000, array(
             'type' => 'string',
             'size' => 1000,
             'notnull' => false,
             'length' => 1000,
             ));
        $this->hasColumn('category_id', 'integer', 2, array(
             'type' => 'integer',
             'size' => 2,
             'unsigned' => true,
             'notnull' => false,
             'length' => 2,
             ));
        $this->hasColumn('expiry_date', 'date', null, array(
             'type' => 'date',
             'notnull' => false,
             ));
        $this->hasColumn('expired', 'boolean', null, array(
             'type' => 'boolean',
             'notnull' => false,
             ));
        $this->hasColumn('billing_unit', 'integer', 2, array(
             'type' => 'integer',
             'unsigned' => true,
             'size' => 2,
             'notnull' => true,
             'length' => 2,
             ));
        $this->hasColumn('form_id', 'integer', 4, array(
             'type' => 'integer',
             'size' => 4,
             'unsigned' => true,
             'length' => 4,
             ));
        $this->hasColumn('price', 'decimal', 18, array(
             'type' => 'decimal',
             'size' => 18,
             'scale' => 2,
             'notnull' => false,
             'length' => 18,
             ));
        $this->hasColumn('template', 'string', 60, array(
             'type' => 'string',
             'size' => 60,
             'notnull' => false,
             'length' => 60,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('billing_unit', array(
             'local' => 'billing_unit',
             'foreign' => 'id',
             'onDelete' => 'SET NULL',
             'onUpdate' => 'CASCADE'));

        $this->hasOne('product_category', array(
             'local' => 'category_id',
             'foreign' => 'id',
             'onDelete' => 'SET NULL',
             'onUpdate' => 'CASCADE'));

        $this->hasOne('submission_form', array(
             'local' => 'form_id',
             'foreign' => 'id',
             'onDelete' => 'SET NULL',
             'onUpdate' => 'CASCADE'));

        $this->hasMany('support_ticket', array(
             'local' => 'id',
             'foreign' => 'product_id'));

        $this->hasMany('subscription_product', array(
             'local' => 'id',
             'foreign' => 'product_id'));

        $this->hasMany('product_usage', array(
             'local' => 'id',
             'foreign' => 'product_id'));
    }
}