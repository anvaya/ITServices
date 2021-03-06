<?php

/**
 * Basemember_coupon
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $coupon_id
 * @property integer $member_id
 * @property string $coupon_code
 * @property boolean $approved
 * @property boolean $used
 * @property integer $product_id
 * @property member $member
 * @property coupon $coupon
 * @property Doctrine_Collection $member_subscription
 * @property Doctrine_Collection $cart
 * @property Doctrine_Collection $order
 * 
 * @method integer             getId()                  Returns the current record's "id" value
 * @method integer             getCouponId()            Returns the current record's "coupon_id" value
 * @method integer             getMemberId()            Returns the current record's "member_id" value
 * @method string              getCouponCode()          Returns the current record's "coupon_code" value
 * @method boolean             getApproved()            Returns the current record's "approved" value
 * @method boolean             getUsed()                Returns the current record's "used" value
 * @method integer             getProductId()           Returns the current record's "product_id" value
 * @method member              getMember()              Returns the current record's "member" value
 * @method coupon              getCoupon()              Returns the current record's "coupon" value
 * @method Doctrine_Collection getMemberSubscription()  Returns the current record's "member_subscription" collection
 * @method Doctrine_Collection getCart()                Returns the current record's "cart" collection
 * @method Doctrine_Collection getOrder()               Returns the current record's "order" collection
 * @method member_coupon       setId()                  Sets the current record's "id" value
 * @method member_coupon       setCouponId()            Sets the current record's "coupon_id" value
 * @method member_coupon       setMemberId()            Sets the current record's "member_id" value
 * @method member_coupon       setCouponCode()          Sets the current record's "coupon_code" value
 * @method member_coupon       setApproved()            Sets the current record's "approved" value
 * @method member_coupon       setUsed()                Sets the current record's "used" value
 * @method member_coupon       setProductId()           Sets the current record's "product_id" value
 * @method member_coupon       setMember()              Sets the current record's "member" value
 * @method member_coupon       setCoupon()              Sets the current record's "coupon" value
 * @method member_coupon       setMemberSubscription()  Sets the current record's "member_subscription" collection
 * @method member_coupon       setCart()                Sets the current record's "cart" collection
 * @method member_coupon       setOrder()               Sets the current record's "order" collection
 * 
 * @package    BestBuddies
 * @subpackage model
 * @author     Anvaya Technologies
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Basemember_coupon extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('member_coupon');
        $this->hasColumn('id', 'integer', 8, array(
             'type' => 'integer',
             'size' => 8,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => true,
             'length' => 8,
             ));
        $this->hasColumn('coupon_id', 'integer', 8, array(
             'type' => 'integer',
             'size' => 8,
             'unsigned' => true,
             'notnull' => false,
             'length' => 8,
             ));
        $this->hasColumn('member_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => false,
             ));
        $this->hasColumn('coupon_code', 'string', 40, array(
             'type' => 'string',
             'size' => 40,
             'notnull' => true,
             'unique' => true,
             'length' => 40,
             ));
        $this->hasColumn('approved', 'boolean', null, array(
             'type' => 'boolean',
             'notnull' => false,
             ));
        $this->hasColumn('used', 'boolean', null, array(
             'type' => 'boolean',
             'notnull' => false,
             ));
        $this->hasColumn('product_id', 'integer', null, array(
             'type' => 'integer',
             'unsigned' => true,
             'notnull' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('member', array(
             'local' => 'member_id',
             'foreign' => 'id',
             'onDelete' => 'SET NULL'));

        $this->hasOne('coupon', array(
             'local' => 'coupon_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasMany('member_subscription', array(
             'local' => 'id',
             'foreign' => 'member_coupon_id'));

        $this->hasMany('cart', array(
             'local' => 'id',
             'foreign' => 'member_coupon_id'));

        $this->hasMany('order', array(
             'local' => 'coupon_code',
             'foreign' => 'discount_voucher_no'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}