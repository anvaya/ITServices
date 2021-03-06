<?php

/**
 * Baseitr_submission
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $member_id
 * @property integer $product_id
 * @property integer $status
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property date $dob
 * @property enum $gender
 * @property string $pan_no
 * @property string $email_address
 * @property string $phone_no
 * @property string $fathers_name
 * @property string $mothers_name
 * @property string $flat_no
 * @property string $premises
 * @property string $street
 * @property string $area
 * @property string $city
 * @property string $state
 * @property string $country
 * @property string $pin
 * @property string $bank_ac_no
 * @property integer $ac_type
 * @property string $ifsc_code
 * @property string $micr_code
 * @property string $notes
 * @property decimal $tax_due
 * @property date $due_date
 * @property boolean $payment_confirmed
 * @property integer $payment_id
 * @property string $ack_file
 * @property member $member
 * @property product $product
 * @property payment $payment
 * @property Doctrine_Collection $itr_property
 * @property Doctrine_Collection $itr_securities
 * @property Doctrine_Collection $itr_other_income
 * @property Doctrine_Collection $itr_exemption
 * @property Doctrine_Collection $itr_file
 * 
 * @method integer             getId()                Returns the current record's "id" value
 * @method integer             getMemberId()          Returns the current record's "member_id" value
 * @method integer             getProductId()         Returns the current record's "product_id" value
 * @method integer             getStatus()            Returns the current record's "status" value
 * @method string              getFirstName()         Returns the current record's "first_name" value
 * @method string              getMiddleName()        Returns the current record's "middle_name" value
 * @method string              getLastName()          Returns the current record's "last_name" value
 * @method date                getDob()               Returns the current record's "dob" value
 * @method enum                getGender()            Returns the current record's "gender" value
 * @method string              getPanNo()             Returns the current record's "pan_no" value
 * @method string              getEmailAddress()      Returns the current record's "email_address" value
 * @method string              getPhoneNo()           Returns the current record's "phone_no" value
 * @method string              getFathersName()       Returns the current record's "fathers_name" value
 * @method string              getMothersName()       Returns the current record's "mothers_name" value
 * @method string              getFlatNo()            Returns the current record's "flat_no" value
 * @method string              getPremises()          Returns the current record's "premises" value
 * @method string              getStreet()            Returns the current record's "street" value
 * @method string              getArea()              Returns the current record's "area" value
 * @method string              getCity()              Returns the current record's "city" value
 * @method string              getState()             Returns the current record's "state" value
 * @method string              getCountry()           Returns the current record's "country" value
 * @method string              getPin()               Returns the current record's "pin" value
 * @method string              getBankAcNo()          Returns the current record's "bank_ac_no" value
 * @method integer             getAcType()            Returns the current record's "ac_type" value
 * @method string              getIfscCode()          Returns the current record's "ifsc_code" value
 * @method string              getMicrCode()          Returns the current record's "micr_code" value
 * @method string              getNotes()             Returns the current record's "notes" value
 * @method decimal             getTaxDue()            Returns the current record's "tax_due" value
 * @method date                getDueDate()           Returns the current record's "due_date" value
 * @method boolean             getPaymentConfirmed()  Returns the current record's "payment_confirmed" value
 * @method integer             getPaymentId()         Returns the current record's "payment_id" value
 * @method string              getAckFile()           Returns the current record's "ack_file" value
 * @method member              getMember()            Returns the current record's "member" value
 * @method product             getProduct()           Returns the current record's "product" value
 * @method payment             getPayment()           Returns the current record's "payment" value
 * @method Doctrine_Collection getItrProperty()       Returns the current record's "itr_property" collection
 * @method Doctrine_Collection getItrSecurities()     Returns the current record's "itr_securities" collection
 * @method Doctrine_Collection getItrOtherIncome()    Returns the current record's "itr_other_income" collection
 * @method Doctrine_Collection getItrExemption()      Returns the current record's "itr_exemption" collection
 * @method Doctrine_Collection getItrFile()           Returns the current record's "itr_file" collection
 * @method itr_submission      setId()                Sets the current record's "id" value
 * @method itr_submission      setMemberId()          Sets the current record's "member_id" value
 * @method itr_submission      setProductId()         Sets the current record's "product_id" value
 * @method itr_submission      setStatus()            Sets the current record's "status" value
 * @method itr_submission      setFirstName()         Sets the current record's "first_name" value
 * @method itr_submission      setMiddleName()        Sets the current record's "middle_name" value
 * @method itr_submission      setLastName()          Sets the current record's "last_name" value
 * @method itr_submission      setDob()               Sets the current record's "dob" value
 * @method itr_submission      setGender()            Sets the current record's "gender" value
 * @method itr_submission      setPanNo()             Sets the current record's "pan_no" value
 * @method itr_submission      setEmailAddress()      Sets the current record's "email_address" value
 * @method itr_submission      setPhoneNo()           Sets the current record's "phone_no" value
 * @method itr_submission      setFathersName()       Sets the current record's "fathers_name" value
 * @method itr_submission      setMothersName()       Sets the current record's "mothers_name" value
 * @method itr_submission      setFlatNo()            Sets the current record's "flat_no" value
 * @method itr_submission      setPremises()          Sets the current record's "premises" value
 * @method itr_submission      setStreet()            Sets the current record's "street" value
 * @method itr_submission      setArea()              Sets the current record's "area" value
 * @method itr_submission      setCity()              Sets the current record's "city" value
 * @method itr_submission      setState()             Sets the current record's "state" value
 * @method itr_submission      setCountry()           Sets the current record's "country" value
 * @method itr_submission      setPin()               Sets the current record's "pin" value
 * @method itr_submission      setBankAcNo()          Sets the current record's "bank_ac_no" value
 * @method itr_submission      setAcType()            Sets the current record's "ac_type" value
 * @method itr_submission      setIfscCode()          Sets the current record's "ifsc_code" value
 * @method itr_submission      setMicrCode()          Sets the current record's "micr_code" value
 * @method itr_submission      setNotes()             Sets the current record's "notes" value
 * @method itr_submission      setTaxDue()            Sets the current record's "tax_due" value
 * @method itr_submission      setDueDate()           Sets the current record's "due_date" value
 * @method itr_submission      setPaymentConfirmed()  Sets the current record's "payment_confirmed" value
 * @method itr_submission      setPaymentId()         Sets the current record's "payment_id" value
 * @method itr_submission      setAckFile()           Sets the current record's "ack_file" value
 * @method itr_submission      setMember()            Sets the current record's "member" value
 * @method itr_submission      setProduct()           Sets the current record's "product" value
 * @method itr_submission      setPayment()           Sets the current record's "payment" value
 * @method itr_submission      setItrProperty()       Sets the current record's "itr_property" collection
 * @method itr_submission      setItrSecurities()     Sets the current record's "itr_securities" collection
 * @method itr_submission      setItrOtherIncome()    Sets the current record's "itr_other_income" collection
 * @method itr_submission      setItrExemption()      Sets the current record's "itr_exemption" collection
 * @method itr_submission      setItrFile()           Sets the current record's "itr_file" collection
 * 
 * @package    BestBuddies
 * @subpackage model
 * @author     Anvaya Technologies
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Baseitr_submission extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('itr_submission');
        $this->hasColumn('id', 'integer', null, array(
             'type' => 'integer',
             'unsigned' => true,
             'primary' => true,
             'autoincrement' => true,
             ));
        $this->hasColumn('member_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => false,
             ));
        $this->hasColumn('product_id', 'integer', 5, array(
             'type' => 'integer',
             'size' => 5,
             'unsigned' => true,
             'notnull' => false,
             'length' => 5,
             ));
        $this->hasColumn('status', 'integer', 1, array(
             'type' => 'integer',
             'size' => 1,
             'notnull' => false,
             'length' => 1,
             ));
        $this->hasColumn('first_name', 'string', 40, array(
             'type' => 'string',
             'size' => 40,
             'notnull' => false,
             'length' => 40,
             ));
        $this->hasColumn('middle_name', 'string', 40, array(
             'type' => 'string',
             'size' => 40,
             'notnull' => false,
             'length' => 40,
             ));
        $this->hasColumn('last_name', 'string', 40, array(
             'type' => 'string',
             'size' => 40,
             'notnull' => false,
             'length' => 40,
             ));
        $this->hasColumn('dob', 'date', null, array(
             'type' => 'date',
             'notnull' => false,
             ));
        $this->hasColumn('gender', 'enum', null, array(
             'type' => 'enum',
             'values' => 
             array(
              0 => 'M',
              1 => 'F',
              2 => 'O',
             ),
             ));
        $this->hasColumn('pan_no', 'string', 12, array(
             'type' => 'string',
             'size' => 12,
             'notnull' => false,
             'length' => 12,
             ));
        $this->hasColumn('email_address', 'string', 100, array(
             'type' => 'string',
             'size' => 100,
             'notnull' => false,
             'length' => 100,
             ));
        $this->hasColumn('phone_no', 'string', 40, array(
             'type' => 'string',
             'size' => 40,
             'notnull' => false,
             'length' => 40,
             ));
        $this->hasColumn('fathers_name', 'string', 120, array(
             'type' => 'string',
             'size' => 120,
             'notnull' => false,
             'length' => 120,
             ));
        $this->hasColumn('mothers_name', 'string', 120, array(
             'type' => 'string',
             'size' => 120,
             'notnull' => false,
             'length' => 120,
             ));
        $this->hasColumn('flat_no', 'string', 255, array(
             'type' => 'string',
             'size' => 255,
             'notnull' => false,
             'length' => 255,
             ));
        $this->hasColumn('premises', 'string', 255, array(
             'type' => 'string',
             'size' => 255,
             'notnull' => false,
             'length' => 255,
             ));
        $this->hasColumn('street', 'string', 255, array(
             'type' => 'string',
             'size' => 255,
             'notnull' => false,
             'length' => 255,
             ));
        $this->hasColumn('area', 'string', 255, array(
             'type' => 'string',
             'size' => 255,
             'notnull' => false,
             'length' => 255,
             ));
        $this->hasColumn('city', 'string', 255, array(
             'type' => 'string',
             'size' => 255,
             'notnull' => false,
             'length' => 255,
             ));
        $this->hasColumn('state', 'string', 20, array(
             'type' => 'string',
             'size' => 20,
             'notnull' => false,
             'length' => 20,
             ));
        $this->hasColumn('country', 'string', 20, array(
             'type' => 'string',
             'size' => 20,
             'notnull' => false,
             'length' => 20,
             ));
        $this->hasColumn('pin', 'string', 20, array(
             'type' => 'string',
             'size' => 20,
             'notnull' => false,
             'length' => 20,
             ));
        $this->hasColumn('bank_ac_no', 'string', 20, array(
             'type' => 'string',
             'size' => 20,
             'notnull' => false,
             'length' => 20,
             ));
        $this->hasColumn('ac_type', 'integer', 1, array(
             'type' => 'integer',
             'size' => 1,
             'notnull' => false,
             'length' => 1,
             ));
        $this->hasColumn('ifsc_code', 'string', 20, array(
             'type' => 'string',
             'size' => 20,
             'notnull' => false,
             'length' => 20,
             ));
        $this->hasColumn('micr_code', 'string', 20, array(
             'type' => 'string',
             'size' => 20,
             'notnull' => false,
             'length' => 20,
             ));
        $this->hasColumn('notes', 'string', 500, array(
             'type' => 'string',
             'size' => 500,
             'notnull' => false,
             'length' => 500,
             ));
        $this->hasColumn('tax_due', 'decimal', null, array(
             'type' => 'decimal',
             'notnull' => false,
             ));
        $this->hasColumn('due_date', 'date', null, array(
             'type' => 'date',
             'notnull' => false,
             ));
        $this->hasColumn('payment_confirmed', 'boolean', null, array(
             'type' => 'boolean',
             'notnull' => true,
             'default' => 0,
             ));
        $this->hasColumn('payment_id', 'integer', 5, array(
             'type' => 'integer',
             'size' => 5,
             'unsigned' => true,
             'notnull' => false,
             'length' => 5,
             ));
        $this->hasColumn('ack_file', 'string', 100, array(
             'type' => 'string',
             'size' => 100,
             'notnull' => false,
             'length' => 100,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('member', array(
             'local' => 'member_id',
             'foreign' => 'id',
             'onDelete' => 'SET NULL'));

        $this->hasOne('product', array(
             'local' => 'product_id',
             'foreign' => 'id',
             'onDelete' => 'SET NULL'));

        $this->hasOne('payment', array(
             'local' => 'payment_id',
             'foreign' => 'id',
             'onDelete' => 'SET NULL'));

        $this->hasMany('itr_property', array(
             'local' => 'id',
             'foreign' => 'submission_id'));

        $this->hasMany('itr_securities', array(
             'local' => 'id',
             'foreign' => 'submission_id'));

        $this->hasMany('itr_other_income', array(
             'local' => 'id',
             'foreign' => 'submission_id'));

        $this->hasMany('itr_exemption', array(
             'local' => 'id',
             'foreign' => 'submission_id'));

        $this->hasMany('itr_file', array(
             'local' => 'id',
             'foreign' => 'submission_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}