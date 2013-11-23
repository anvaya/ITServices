<?php

/**
 * Basesubmission_inner_data
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $submission_inner_id
 * @property integer $question_id
 * @property varchar $answser_text
 * @property varchar $selected_options
 * @property varchar $answer_files
 * @property submission_inner $submission_inner
 * @property form_question $form_question
 * 
 * @method integer               getId()                  Returns the current record's "id" value
 * @method integer               getSubmissionInnerId()   Returns the current record's "submission_inner_id" value
 * @method integer               getQuestionId()          Returns the current record's "question_id" value
 * @method varchar               getAnswserText()         Returns the current record's "answser_text" value
 * @method varchar               getSelectedOptions()     Returns the current record's "selected_options" value
 * @method varchar               getAnswerFiles()         Returns the current record's "answer_files" value
 * @method submission_inner      getSubmissionInner()     Returns the current record's "submission_inner" value
 * @method form_question         getFormQuestion()        Returns the current record's "form_question" value
 * @method submission_inner_data setId()                  Sets the current record's "id" value
 * @method submission_inner_data setSubmissionInnerId()   Sets the current record's "submission_inner_id" value
 * @method submission_inner_data setQuestionId()          Sets the current record's "question_id" value
 * @method submission_inner_data setAnswserText()         Sets the current record's "answser_text" value
 * @method submission_inner_data setSelectedOptions()     Sets the current record's "selected_options" value
 * @method submission_inner_data setAnswerFiles()         Sets the current record's "answer_files" value
 * @method submission_inner_data setSubmissionInner()     Sets the current record's "submission_inner" value
 * @method submission_inner_data setFormQuestion()        Sets the current record's "form_question" value
 * 
 * @package    BestBuddies
 * @subpackage model
 * @author     Anvaya Technologies
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Basesubmission_inner_data extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('submission_inner_data');
        $this->hasColumn('id', 'integer', 8, array(
             'type' => 'integer',
             'size' => 8,
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => true,
             'length' => 8,
             ));
        $this->hasColumn('submission_inner_id', 'integer', 8, array(
             'type' => 'integer',
             'size' => 8,
             'unsigned' => true,
             'notnull' => true,
             'length' => 8,
             ));
        $this->hasColumn('question_id', 'integer', 4, array(
             'type' => 'integer',
             'size' => 4,
             'unsigned' => true,
             'notnull' => false,
             'length' => 4,
             ));
        $this->hasColumn('answser_text', 'varchar', 2000, array(
             'type' => 'varchar',
             'notnull' => false,
             'length' => 2000,
             ));
        $this->hasColumn('selected_options', 'varchar', 2000, array(
             'type' => 'varchar',
             'notnull' => false,
             'length' => 2000,
             ));
        $this->hasColumn('answer_files', 'varchar', 2000, array(
             'type' => 'varchar',
             'notnull' => false,
             'length' => 2000,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('submission_inner', array(
             'local' => 'submission_inner_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE',
             'onUpdate' => 'CASCADE'));

        $this->hasOne('form_question', array(
             'local' => 'question_id',
             'foreign' => 'id',
             'onDelete' => 'SET NULL',
             'onUpdate' => 'CASCADE'));
    }
}