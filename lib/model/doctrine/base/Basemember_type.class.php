<?php

/**
 * Basemember_type
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property varchar $type_name
 * @property varchar $description
 * @property Doctrine_Collection $member
 * 
 * @method integer             getId()          Returns the current record's "id" value
 * @method varchar             getTypeName()    Returns the current record's "type_name" value
 * @method varchar             getDescription() Returns the current record's "description" value
 * @method Doctrine_Collection getMember()      Returns the current record's "member" collection
 * @method member_type         setId()          Sets the current record's "id" value
 * @method member_type         setTypeName()    Sets the current record's "type_name" value
 * @method member_type         setDescription() Sets the current record's "description" value
 * @method member_type         setMember()      Sets the current record's "member" collection
 * 
 * @package    BestBuddies
 * @subpackage model
 * @author     Anvaya Technologies
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Basemember_type extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('member_type');
        $this->hasColumn('id', 'integer', 2, array(
             'type' => 'integer',
             'size' => 2,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => true,
             'length' => 2,
             ));
        $this->hasColumn('type_name', 'varchar', 45, array(
             'type' => 'varchar',
             'unique' => true,
             'notnull' => true,
             'length' => 45,
             ));
        $this->hasColumn('description', 'varchar', 255, array(
             'type' => 'varchar',
             'notnull' => false,
             'length' => 255,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('member', array(
             'local' => 'id',
             'foreign' => 'member_type_id'));
    }
}