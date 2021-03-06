<?php

/**
 * Basetype_info
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $type_id
 * @property string $type_name
 * @property boolean $disabled
 * 
 * @method integer   getId()        Returns the current record's "id" value
 * @method integer   getTypeId()    Returns the current record's "type_id" value
 * @method string    getTypeName()  Returns the current record's "type_name" value
 * @method boolean   getDisabled()  Returns the current record's "disabled" value
 * @method type_info setId()        Sets the current record's "id" value
 * @method type_info setTypeId()    Sets the current record's "type_id" value
 * @method type_info setTypeName()  Sets the current record's "type_name" value
 * @method type_info setDisabled()  Sets the current record's "disabled" value
 * 
 * @package    BestBuddies
 * @subpackage model
 * @author     Anvaya Technologies
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Basetype_info extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('type_info');
        $this->hasColumn('id', 'integer', 2, array(
             'type' => 'integer',
             'size' => 2,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => true,
             'length' => 2,
             ));
        $this->hasColumn('type_id', 'integer', 2, array(
             'type' => 'integer',
             'size' => 2,
             'notnull' => true,
             'length' => 2,
             ));
        $this->hasColumn('type_name', 'string', 100, array(
             'type' => 'string',
             'size' => 100,
             'notnull' => true,
             'length' => 100,
             ));
        $this->hasColumn('disabled', 'boolean', null, array(
             'type' => 'boolean',
             'notnull' => false,
             ));

        $this->setSubClasses(array(
             'product_category' => 
             array(
              'type_id' => 1,
             ),
             'department' => 
             array(
              'type_id' => 2,
             ),
             'billing_unit' => 
             array(
              'type_id' => 3,
             ),
             'exemption_category' => 
             array(
              'type_id' => 4,
             ),
             ));
    }

    public function setUp()
    {
        parent::setUp();
        
    }
}