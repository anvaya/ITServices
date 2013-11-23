<?php

/**
 * Basepayment
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $member_id
 * @property integer $submission_id
 * @property integer $subscription_id
 * @property integer $payment_type
 * @property date $payment_date
 * @property varchar $bank_name
 * @property varchar $branch
 * @property varchar $payment_ref_no
 * @property varchar $transaction_id
 * @property decimal $amount
 * @property varchar $routed_through
 * @property integer $status
 * @property integer $ip_address
 * @property member_subscription $member_subscription
 * @property submission $submission
 * @property member $member
 * 
 * @method integer             getId()                  Returns the current record's "id" value
 * @method integer             getMemberId()            Returns the current record's "member_id" value
 * @method integer             getSubmissionId()        Returns the current record's "submission_id" value
 * @method integer             getSubscriptionId()      Returns the current record's "subscription_id" value
 * @method integer             getPaymentType()         Returns the current record's "payment_type" value
 * @method date                getPaymentDate()         Returns the current record's "payment_date" value
 * @method varchar             getBankName()            Returns the current record's "bank_name" value
 * @method varchar             getBranch()              Returns the current record's "branch" value
 * @method varchar             getPaymentRefNo()        Returns the current record's "payment_ref_no" value
 * @method varchar             getTransactionId()       Returns the current record's "transaction_id" value
 * @method decimal             getAmount()              Returns the current record's "amount" value
 * @method varchar             getRoutedThrough()       Returns the current record's "routed_through" value
 * @method integer             getStatus()              Returns the current record's "status" value
 * @method integer             getIpAddress()           Returns the current record's "ip_address" value
 * @method member_subscription getMemberSubscription()  Returns the current record's "member_subscription" value
 * @method submission          getSubmission()          Returns the current record's "submission" value
 * @method member              getMember()              Returns the current record's "member" value
 * @method payment             setId()                  Sets the current record's "id" value
 * @method payment             setMemberId()            Sets the current record's "member_id" value
 * @method payment             setSubmissionId()        Sets the current record's "submission_id" value
 * @method payment             setSubscriptionId()      Sets the current record's "subscription_id" value
 * @method payment             setPaymentType()         Sets the current record's "payment_type" value
 * @method payment             setPaymentDate()         Sets the current record's "payment_date" value
 * @method payment             setBankName()            Sets the current record's "bank_name" value
 * @method payment             setBranch()              Sets the current record's "branch" value
 * @method payment             setPaymentRefNo()        Sets the current record's "payment_ref_no" value
 * @method payment             setTransactionId()       Sets the current record's "transaction_id" value
 * @method payment             setAmount()              Sets the current record's "amount" value
 * @method payment             setRoutedThrough()       Sets the current record's "routed_through" value
 * @method payment             setStatus()              Sets the current record's "status" value
 * @method payment             setIpAddress()           Sets the current record's "ip_address" value
 * @method payment             setMemberSubscription()  Sets the current record's "member_subscription" value
 * @method payment             setSubmission()          Sets the current record's "submission" value
 * @method payment             setMember()              Sets the current record's "member" value
 * 
 * @package    BestBuddies
 * @subpackage model
 * @author     Anvaya Technologies
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Basepayment extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('payment');
        $this->hasColumn('id', 'integer', 8, array(
             'type' => 'integer',
             'size' => 8,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => true,
             'length' => 8,
             ));
        $this->hasColumn('member_id', 'integer', 8, array(
             'type' => 'integer',
             'size' => 8,
             'unsigned' => true,
             'notnull' => true,
             'length' => 8,
             ));
        $this->hasColumn('submission_id', 'integer', 8, array(
             'type' => 'integer',
             'size' => 8,
             'unsigned' => true,
             'notnull' => false,
             'length' => 8,
             ));
        $this->hasColumn('subscription_id', 'integer', 5, array(
             'type' => 'integer',
             'size' => 5,
             'unsigned' => true,
             'notnull' => false,
             'length' => 5,
             ));
        $this->hasColumn('payment_type', 'integer', 1, array(
             'type' => 'integer',
             'size' => 1,
             'unsigned' => true,
             'notnull' => false,
             'length' => 1,
             ));
        $this->hasColumn('payment_date', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('bank_name', 'varchar', 50, array(
             'type' => 'varchar',
             'notnull' => false,
             'length' => 50,
             ));
        $this->hasColumn('branch', 'varchar', 50, array(
             'type' => 'varchar',
             'notnull' => false,
             'length' => 50,
             ));
        $this->hasColumn('payment_ref_no', 'varchar', 50, array(
             'type' => 'varchar',
             'notnull' => false,
             'length' => 50,
             ));
        $this->hasColumn('transaction_id', 'varchar', 50, array(
             'type' => 'varchar',
             'notnull' => false,
             'length' => 50,
             ));
        $this->hasColumn('amount', 'decimal', null, array(
             'type' => 'decimal',
             'notnull' => false,
             ));
        $this->hasColumn('routed_through', 'varchar', 50, array(
             'type' => 'varchar',
             'notnull' => false,
             'length' => 50,
             ));
        $this->hasColumn('status', 'integer', 1, array(
             'type' => 'integer',
             'size' => 1,
             'unsigned' => true,
             'notnull' => false,
             'length' => 1,
             ));
        $this->hasColumn('ip_address', 'integer', null, array(
             'type' => 'integer',
             'notnull' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('member_subscription', array(
             'local' => 'subscription_id',
             'foreign' => 'id',
             'onDelete' => 'SET NULL',
             'onUpdate' => 'CASCADE'));

        $this->hasOne('submission', array(
             'local' => 'submission_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE',
             'onUpdate' => 'CASCADE'));

        $this->hasOne('member', array(
             'local' => 'member_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}