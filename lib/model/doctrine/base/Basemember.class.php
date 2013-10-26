<?php

/**
 * Basemember
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property member_type $member_type
 * @property Doctrine_Collection $contact
 * @property Doctrine_Collection $address
 * 
 * @method member_type         getMemberType()  Returns the current record's "member_type" value
 * @method Doctrine_Collection getContact()     Returns the current record's "contact" collection
 * @method Doctrine_Collection getAddress()     Returns the current record's "address" collection
 * @method member              setMemberType()  Sets the current record's "member_type" value
 * @method member              setContact()     Sets the current record's "contact" collection
 * @method member              setAddress()     Sets the current record's "address" collection
 * 
 * @package    BestBuddies
 * @subpackage model
 * @author     Anvaya Technologies
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Basemember extends sfGuardUser
{
    public function setUp()
    {
        parent::setUp();
        $this->hasOne('member_type', array(
             'local' => 'member_type_id',
             'foreign' => 'id',
             'onDelete' => 'SET NULL',
             'onUpdate' => 'CASCADE'));

        $this->hasMany('contact', array(
             'local' => 'id',
             'foreign' => 'member_id'));

        $this->hasMany('address', array(
             'local' => 'id',
             'foreign' => 'member_id'));
    }
}