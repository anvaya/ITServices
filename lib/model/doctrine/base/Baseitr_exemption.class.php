<?php

/**
 * Baseitr_exemption
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $submission_id
 * @property integer $category_id
 * @property decimal $amount
 * @property itr_submission $itr_submission
 * @property exemption_category $exemption_category
 * 
 * @method integer            getId()                 Returns the current record's "id" value
 * @method integer            getSubmissionId()       Returns the current record's "submission_id" value
 * @method integer            getCategoryId()         Returns the current record's "category_id" value
 * @method decimal            getAmount()             Returns the current record's "amount" value
 * @method itr_submission     getItrSubmission()      Returns the current record's "itr_submission" value
 * @method exemption_category getExemptionCategory()  Returns the current record's "exemption_category" value
 * @method itr_exemption      setId()                 Sets the current record's "id" value
 * @method itr_exemption      setSubmissionId()       Sets the current record's "submission_id" value
 * @method itr_exemption      setCategoryId()         Sets the current record's "category_id" value
 * @method itr_exemption      setAmount()             Sets the current record's "amount" value
 * @method itr_exemption      setItrSubmission()      Sets the current record's "itr_submission" value
 * @method itr_exemption      setExemptionCategory()  Sets the current record's "exemption_category" value
 * 
 * @package    BestBuddies
 * @subpackage model
 * @author     Anvaya Technologies
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Baseitr_exemption extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('itr_exemption');
        $this->hasColumn('id', 'integer', null, array(
             'type' => 'integer',
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('submission_id', 'integer', null, array(
             'type' => 'integer',
             'unsigned' => true,
             'notnull' => false,
             ));
        $this->hasColumn('category_id', 'integer', 2, array(
             'type' => 'integer',
             'size' => 2,
             'unsigned' => true,
             'length' => 2,
             ));
        $this->hasColumn('amount', 'decimal', 19, array(
             'type' => 'decimal',
             'size' => 19,
             'scale' => 2,
             'notnull' => false,
             'length' => 19,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('itr_submission', array(
             'local' => 'submission_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE',
             'onUpdate' => 'CASCADE'));

        $this->hasOne('exemption_category', array(
             'local' => 'category_id',
             'foreign' => 'id',
             'onDelete' => 'SET NULL'));
    }
}