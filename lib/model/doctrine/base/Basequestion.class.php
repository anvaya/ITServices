<?php

/**
 * Basequestion
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $answer_type
 * @property varchar $question_text
 * @property varchar $help_message
 * @property integer $parent_question_id
 * @property boolean $disabled
 * @property question $ParentQuestion
 * @property Doctrine_Collection $question
 * 
 * @method integer             getId()                 Returns the current record's "id" value
 * @method integer             getAnswerType()         Returns the current record's "answer_type" value
 * @method varchar             getQuestionText()       Returns the current record's "question_text" value
 * @method varchar             getHelpMessage()        Returns the current record's "help_message" value
 * @method integer             getParentQuestionId()   Returns the current record's "parent_question_id" value
 * @method boolean             getDisabled()           Returns the current record's "disabled" value
 * @method question            getParentQuestion()     Returns the current record's "ParentQuestion" value
 * @method Doctrine_Collection getQuestion()           Returns the current record's "question" collection
 * @method question            setId()                 Sets the current record's "id" value
 * @method question            setAnswerType()         Sets the current record's "answer_type" value
 * @method question            setQuestionText()       Sets the current record's "question_text" value
 * @method question            setHelpMessage()        Sets the current record's "help_message" value
 * @method question            setParentQuestionId()   Sets the current record's "parent_question_id" value
 * @method question            setDisabled()           Sets the current record's "disabled" value
 * @method question            setParentQuestion()     Sets the current record's "ParentQuestion" value
 * @method question            setQuestion()           Sets the current record's "question" collection
 * 
 * @package    BestBuddies
 * @subpackage model
 * @author     Anvaya Technologies
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Basequestion extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('question');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'size' => 4,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('answer_type', 'integer', 1, array(
             'type' => 'integer',
             'size' => 1,
             'unsigned' => true,
             'notnull' => true,
             'length' => 1,
             ));
        $this->hasColumn('question_text', 'varchar', 400, array(
             'type' => 'varchar',
             'notnull' => true,
             'length' => 400,
             ));
        $this->hasColumn('help_message', 'varchar', 400, array(
             'type' => 'varchar',
             'notnull' => false,
             'length' => 400,
             ));
        $this->hasColumn('parent_question_id', 'integer', 4, array(
             'type' => 'integer',
             'size' => 4,
             'unsigned' => true,
             'notnull' => false,
             'length' => 4,
             ));
        $this->hasColumn('disabled', 'boolean', null, array(
             'type' => 'boolean',
             'notnull' => true,
             'default' => 0,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('question as ParentQuestion', array(
             'local' => 'parent_question_id',
             'foreign' => 'id',
             'onDelete' => 'SET NULL',
             'onUpdate' => 'CASCADE'));

        $this->hasMany('question', array(
             'local' => 'id',
             'foreign' => 'parent_question_id'));
    }
}