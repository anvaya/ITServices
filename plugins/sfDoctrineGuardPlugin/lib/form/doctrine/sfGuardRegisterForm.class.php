<?php

/**
 * sfGuardRegisterForm for registering new users
 *
 * @package    sfDoctrineGuardPlugin
 * @subpackage form
 * @author     Jonathan H. Wage <jonwage@gmail.com>
 * @version    SVN: $Id: BasesfGuardChangeUserPasswordForm.class.php 23536 2009-11-02 21:41:21Z Kris.Wallsmith $
 */
class sfGuardRegisterForm extends BasesfGuardRegisterForm
{
  /**
   * @see sfForm
   */
  public function configure()
  {
    unset($this['is_member'],$this['member_type_id'],$this['country'],$this['application_id'],$this['timezone'],$this['culture']);
    

      $this->widgetSchema['email_address'] = new sfWidgetFormInputText(array(),array('class'=>'required'));
      $this->validatorSchema['email_address'] = new sfValidatorEmail(array("required"=>true),array('required'=> 'Email address is mandatory.','invalid'=>'Invalid Email address.'));              

      $this->widgetSchema['username'] = new sfWidgetFormInputText(array(),array('class'=>'required'));
      $this->validatorSchema['username'] = new sfValidatorString(array('max_length' => 128),array('required'=> 'You must provide an Username'));
    
    
    $this->widgetSchema['password'] = new sfWidgetFormInputPassword(array(),array('class'=>'required'));
    //$this->validatorSchema['password']->setOption('required', true);
    $this->validatorSchema['password'] = new sfValidatorString(array('max_length' => 32),array('required'=> 'You must provide a password.'));
    
    $this->widgetSchema['password_again'] = new sfWidgetFormInputPassword(array(),array('class'=>'required'));
    $this->validatorSchema['password_again'] = clone $this->validatorSchema['password'];

    $this->validatorSchema['first_name'] = new sfValidatorString(array('max_length' => 50),array('required'=> 'Your first name is required.'));
    $this->validatorSchema['last_name'] = new sfValidatorString(array('max_length' => 50),array('required'=> 'Your last name is required.'));
    $this->validatorSchema['middle_name'] = new sfValidatorString(array('max_length' => 50),array('required'=> 'Your middle name is required.'));
    
    
    $this->widgetSchema['gender'] = new sfWidgetFormChoice(array('choices' => array('M' => 'Male', 'F' => 'Female')));

    $this->widgetSchema['other_income_source'] = new sfWidgetFormChoice(array('choices' => array( "" => "---Select---",
"A" => "Income from capital gains", 
"B" => "Income from house property", 
"C" => "Income from other sources", 
"D" => "Income from capital gains &amp; house property", 
"E" => "Income from house property &amp; other sources", 
"F" => "Income from capital gains &amp; other sources", 
"G" => "Income from capital gains, house property &amp; other sources", 
"H" => "No income" )
));
    
    $css_mandatory = "<span class='mandatory'>* </span>";
    $this->widgetSchema->setLabel('email_address', $css_mandatory . "Email address");
    $this->widgetSchema->setLabel('username', $css_mandatory . "Username");
    $this->widgetSchema->setLabel('password', $css_mandatory . "Password");
    $this->widgetSchema->setLabel('password_again', $css_mandatory . "Password again");

    
    $this->validatorSchema->setPostValidator(
      new sfValidatorAnd(array(
        new sfValidatorDoctrineUnique(array('model' => 'sfGuardUser', 'column' => array('email_address')),array('invalid' => 'Email address already exist.')),
        new sfValidatorDoctrineUnique(array('model' => 'sfGuardUser', 'column' => array('username')),array('invalid' => 'username already exist.')),
      ))
    );
    
    $this->mergePostValidator(new sfValidatorSchemaCompare('password', sfValidatorSchemaCompare::EQUAL, 'password_again', array(), array('invalid' => 'The two passwords must be the same.')));

    $years = array();
    for($i=date('Y')-80; $i<=date('Y')-18; $i++)
        $years[$i] = $i;
    
    //$years = range(date('Y')-80, date('Y')-18);       
    
    $this->widgetSchema['dob']->setOption("format","%day%/%month%/%year%");
    $this->widgetSchema['dob']->setOption('years',$years);
    $this->widgetSchema['dob']->setLabel('Date of Birth (As per PAN Card)');
    $this->validatorSchema['dob'] = new sfValidatorDate();
    
    $occupations = array(
        sfGuardUserTable::OCCUPATION_TYPE_UNKNOWN=>"---Select---",
        sfGuardUserTable::OCCUPATION_TYPE_SALARY=>'I am an Salaried Employee',
        sfGuardUserTable::OCCUPATION_TYPE_BUSINESS=>'I am engaged in business / Profession',        
    );
    
    $this->widgetSchema['occupation_type'] = new sfWidgetFormChoice(array("choices"=>$occupations));
    $this->validatorSchema['occupation_type'] = new sfValidatorChoice(array("choices"=>array_keys($occupations),"required"=>false));
    

    $nri_address = new address();
    $nri_address->setAddressType(addressTable::ADDRESS_TYPE_NRI);
    $this->embedForm("nri_address", new addressForm($nri_address, array( "address_type"=>addressTable::ADDRESS_TYPE_NRI)));
    
    //$this->embedForm("nri_address", new addressForm(null, array('address_type'=> addressTable::ADDRESS_TYPE_NRI)));
    $in_address = new address();
    $in_address->setCountry("IN");
    $in_address->setAddressType(addressTable::ADDRESS_TYPE_IND);
    $this->embedForm("in_address", new addressForm($in_address,array( "address_type"=>addressTable::ADDRESS_TYPE_IND)));    
    
    $nri_mobile = new contact();
    $nri_mobile->setContactType(contactTable::CONTACT_TYPE_MOBILE);
    $this->embedForm("nri_mobile",  new contactForm($nri_mobile, array( "contact_type"=>contactTable::CONTACT_TYPE_MOBILE)));
    
    $nri_landline = new contact();
    $nri_landline->setContactType(contactTable::CONTACT_TYPE_LANDLINE);
    $this->embedForm("nri_landline", new contactForm($nri_landline, array( "contact_type"=>contactTable::CONTACT_TYPE_LANDLINE)));
    
    $nri_office = new contact();
    $nri_office->setContactType(contactTable::CONTACT_TYPE_OFFICE);
    $this->embedForm("nri_office", new contactForm($nri_office, array("contact_type"=>contactTable::CONTACT_TYPE_OFFICE)));
    
    $nri_fax = new contact();
    $nri_fax->setContactType(contactTable::CONTACT_TYPE_FAX);
    $this->embedForm("nri_fax", new contactForm($nri_fax, array("contact_type"=>contactTable::CONTACT_TYPE_FAX)));    
    
    $in_mobile = new contact();
    $in_mobile->setContactType(contactTable::CONTACT_TYPE_MOBILE);
    $in_mobile->setIsdCode('91');
    $in_mobile->setCountry('IN');
    $this->embedForm("in_mobile", new contactForm($in_mobile, array("contact_type"=>contactTable::CONTACT_TYPE_MOBILE,'isd_code' => 91)));
    
    $in_landline = new contact();
    $in_landline->setContactType(contactTable::CONTACT_TYPE_LANDLINE);
    $in_landline->setIsdCode('91');
    $in_landline->setCountry('IN');
    $this->embedForm("in_landline", new contactForm($in_landline, array("contact_type"=>contactTable::CONTACT_TYPE_LANDLINE, 'isd_code' => 91)));
    
    $this->widgetSchema['nri_address']->setLabel(" ");
    $this->widgetSchema['in_address']->setLabel(" ");
    $this->widgetSchema['nri_mobile']->setLabel("Mobile");
    $this->widgetSchema['nri_landline']->setLabel("Landline");
    $this->widgetSchema['nri_office']->setLabel("Office");
    $this->widgetSchema['nri_fax']->setLabel("Fax");
    
    $this->widgetSchema['in_mobile']->setLabel("Mobile");
    $this->widgetSchema['in_landline']->setLabel("Landline");
    
    $subscription = new member_subscription();    
    $subscription_form = new member_subscription_subForm($subscription);
    $this->embedForm("subscription", $subscription_form);    
  }
  
  public function saveEmbeddedForms($con = null, $forms = null)
  {
    if (is_null($con))
    {
      $con = $this->getConnection();
    }
 
    if (is_null($forms))
    {
      $forms = $this->embeddedForms;
    }
 
    foreach ($forms as $name => $form)
    {
      if ($form instanceof sfFormDoctrine)
      {
        // The magic start here
        /*$field_name  = $this->getObject()->getTable()->getTableName().'_id';
        if($form->getObject()->contains($field_name)) {
          $method_name = 'set'.sfInflector::camelize($field_name);
          $form->getObject()->$method_name($this->getObject()->getId());
        }*/
        $form->getObject()->setMemberId($this->getObject()->getId());        
        // Here it ends
        $form->getObject()->save($con);
        $form->saveEmbeddedForms($con);
      }
      else
      {
        $this->saveEmbeddedForms($con, $form->getEmbeddedForms());
      }
    }  
  }
}