<?php

/**
 * address form.
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class addressForm extends BaseaddressForm
{
  public function configure()
  {
      unset($this['member_id']);
     
      $this->widgetSchema['address_type'] = new sfWidgetFormInputHidden();
      $this->validatorSchema['address_type'] = new sfValidatorPass();          

      $address_type =  $this->getOption("address_type", null);
      if($address_type == addressTable::ADDRESS_TYPE_IND)
      {
        $choices = array( ""=>"--Select--",
                                "1"=>"Andaman &amp; Nicobar Islands",
                                "2"=>"Andhra Pradesh",
                                "3"=>"Arunachal Pradesh",
                                "4"=>"Assam",
                                "5"=>"Bihar",
                                "6"=>"Chandigarh",
                                "33"=>"Chhattisgarh",
                                "7"=>"Dadra &amp; Nagar Haveli",
                                "8"=>"Daman &amp; Diu",
                                "9"=>"Delhi",
                                "10"=>"Goa",
                                "11"=>"Gujarat",
                                "12"=>"Haryana",
                                "13"=>"Himachal Pradesh",
                                "14"=>"Jammu &amp; Kashmir",
                                "35"=>"Jharkhand",
                                "15"=>"Karnataka",
                                "16"=>"Kerala",
                                "17"=>"Lakhswadeep",
                                "18"=>"Madhya Pradesh",
                                "19"=>"Maharashtra",
                                "20"=>"Manipur",
                                "21"=>"Meghalaya",
                                "22"=>"Mizoram",
                                "23"=>"Nagaland",
                                "24"=>"Orissa",
                                "25"=>"Pondicherry",
                                "26"=>"Punjab",
                                "27"=>"Rajasthan",
                                "28"=>"Sikkim",
                                "29"=>"Tamil Nadu",
                                "30"=>"Tripura",
                                "31"=>"Uttar Pradesh",
                                "32"=>"West Bengal",
                                "34"=>"Uttaranchal");
                                
              
        $this->widgetSchema["state"] = new sfWidgetFormChoice(array("choices"=>$choices));
        $this->validatorSchema["state"] = new sfValidatorChoice(array("required"=>false, "choices"=>array_keys($choices)) );
                
          
        $this->widgetSchema['country'] = new sfWidgetFormInputHidden(array('default'=> 'IN'));
      }
      else
        $this->widgetSchema['country'] = new sfWidgetFormI18nChoiceCountry(array('add_empty'=> '---Select---'));
      
      $this->widgetSchema['pin']->setLabel('Pin Code/Zip');
  }
}
