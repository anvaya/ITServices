<?php

/**
 * Baseemail_directory
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $directory_key
 * @property string $title
 * @property string $send_to
 * @property string $email_subject
 * @property string $email_template
 * @property boolean $is_html
 * 
 * @method string          getDirectoryKey()   Returns the current record's "directory_key" value
 * @method string          getTitle()          Returns the current record's "title" value
 * @method string          getSendTo()         Returns the current record's "send_to" value
 * @method string          getEmailSubject()   Returns the current record's "email_subject" value
 * @method string          getEmailTemplate()  Returns the current record's "email_template" value
 * @method boolean         getIsHtml()         Returns the current record's "is_html" value
 * @method email_directory setDirectoryKey()   Sets the current record's "directory_key" value
 * @method email_directory setTitle()          Sets the current record's "title" value
 * @method email_directory setSendTo()         Sets the current record's "send_to" value
 * @method email_directory setEmailSubject()   Sets the current record's "email_subject" value
 * @method email_directory setEmailTemplate()  Sets the current record's "email_template" value
 * @method email_directory setIsHtml()         Sets the current record's "is_html" value
 * 
 * @package    BestBuddies
 * @subpackage model
 * @author     Anvaya Technologies
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Baseemail_directory extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('email_directory');
        $this->hasColumn('directory_key', 'string', 255, array(
             'type' => 'string',
             'size' => 255,
             'unique' => true,
             'primary' => true,
             'length' => 255,
             ));
        $this->hasColumn('title', 'string', 255, array(
             'type' => 'string',
             'size' => 255,
             'notnull' => false,
             'length' => 255,
             ));
        $this->hasColumn('send_to', 'string', 4000, array(
             'type' => 'string',
             'size' => 4000,
             'notnull' => false,
             'length' => 4000,
             ));
        $this->hasColumn('email_subject', 'string', 255, array(
             'type' => 'string',
             'size' => 255,
             'notnull' => false,
             'length' => 255,
             ));
        $this->hasColumn('email_template', 'string', 4000, array(
             'type' => 'string',
             'size' => 4000,
             'notnull' => false,
             'length' => 4000,
             ));
        $this->hasColumn('is_html', 'boolean', null, array(
             'type' => 'boolean',
             'notnull' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}