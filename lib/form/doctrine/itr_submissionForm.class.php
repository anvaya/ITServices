<?php

/**
 * itr_submission form.
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class itr_submissionForm extends Baseitr_submissionForm
{
  public function configure()
  {
     
      
      $this->embedForm("properties", new itrPropertyCollectionForm(  array(), array("itr_submission"=>$this->getObject()) ) );
      //$this->embedForm("securities", new itrSecuritiesCollectionForm( array(), array("itr_submission"=>$this->getObject()) ) );
      
      $this->embedForm("otherincome1", new itrOtherIncomeCollectionForm( array(), array("category_id"=>1, "itr_submission"=>$this->getObject()) ) );
      $this->embedForm("otherincome2", new itrOtherIncomeCollectionForm( array(), array("category_id"=>2, "itr_submission"=>$this->getObject()) ) );
      $this->embedForm("otherincome3", new itrOtherIncomeCollectionForm( array(), array("category_id"=>3, "itr_submission"=>$this->getObject()) ) );
      $this->embedForm("otherincome4", new itrOtherIncomeCollectionForm( array(), array("category_id"=>4, "itr_submission"=>$this->getObject()) ) );
      $this->embedForm("otherincome5", new itrOtherIncomeCollectionForm( array(), array("category_id"=>5, "itr_submission"=>$this->getObject()) ) );
      
      $this->embedForm("capitals1", new itrSecuritiesCollectionForm( array(), array("category_id"=>1, "itr_submission"=>$this->getObject()) ) );
      $this->embedForm("capitals2", new itrSecuritiesCollectionForm( array(), array("category_id"=>2, "itr_submission"=>$this->getObject()) ) );
      $this->embedForm("capitals3", new itrSecuritiesCollectionForm( array(), array("category_id"=>3, "itr_submission"=>$this->getObject()) ) );
      $this->embedForm("capitals4", new itrSecuritiesCollectionForm( array(), array("category_id"=>4, "itr_submission"=>$this->getObject()) ) );
      $this->embedForm("capitals5", new itrSecuritiesCollectionForm( array(), array("category_id"=>5, "itr_submission"=>$this->getObject()) ) );
      $this->embedForm("capitals6", new itrSecuritiesCollectionForm( array(), array("category_id"=>6, "itr_submission"=>$this->getObject()) ) );
      $this->embedForm("capitals7", new itrSecuritiesCollectionForm( array(), array("category_id"=>7, "itr_submission"=>$this->getObject()) ) );
      
      $this->widgetSchema['notes']->setAttribute('rows',10);
      $this->widgetSchema['notes']->setAttribute('cols',80);
      
      $this->embedForm("itr_files", new itrFilesCollectionForm(array(), array("itr_submission"=>$this->getObject() ) )  );
      
      $this->embedForm("exemptions", new itrExemptionsCollectionForm( array(), array("itr_submission"=>$this->getObject()) ) );
      
       $choices = array(                 
          itr_submissionTable::AC_TYPE_NRO =>"NRO",
          itr_submissionTable::AC_TYPE_SAVINGS=>"Savings",                         
      );
       
      $this->widgetSchema['ac_type'] = new sfWidgetFormChoice(array("choices"=>$choices));
      $this->validatorSchema['ac_type'] = new sfValidatorChoice(array("choices"=>array_keys($choices),"required"=>true));
      
      $gender_choice = array("M"=>"Male","F"=>"Female");
      $this->widgetSchema['gender'] = new sfWidgetFormChoice(array("choices"=>$gender_choice));
      
      $min_year = 1931;
      $max_year = date('Y')-17;

      if($min_year == 0) $min_year = date('Y')-5;
      if($max_year == 0) $max_year = date('Y') + 5;

      $years_range = range($min_year, $max_year);
      $years = array();
      foreach($years_range as $item)
      {
            $years[$item] = $item;
      }

      $this->widgetSchema['pan_no']->setAttribute('maxlength',10);
      
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
                                "34"=>"Uttaranchal",
                                "99"=>"Outside India");
      
      $this->widgetSchema['state'] = new sfWidgetFormChoice(array("choices"=>$choices));
      $this->validatorSchema['state'] = new sfValidatorChoice(array("choices"=>array_keys($choices),"required"=>true));
      
      $this->widgetSchema['country'] = new sfWidgetFormI18nChoiceCountry();
      $this->validatorSchema['country'] = new sfValidatorI18nChoiceCountry(array("required"=>true));      
      
      $date_widget = new sfWidgetFormDate(array("years"=>$years,"format"=>"%day%/%month%/%year%"));
             
      $this->widgetSchema["dob"] = new sfWidgetFormJQueryDate(array("date_widget"=>$date_widget), array('class' => "required", 'error_msg'=> "Required" ));
      $this->validatorSchema["dob"] = new sfValidatorDate(array("required"=>true) );
        
      $this->widgetSchema['product_id'] = new sfWidgetFormInputHidden();
      $this->validatorSchema['product_id']->setOption('required', true);
      
      $this->validatorSchema['email_address'] = new sfValidatorEmail();
      $required = array("dob","first_name","middle_name","last_name","pan_no","email_address","phone_no","bank_ac_no","ifsc_code","fathers_name","micr_code");
      foreach($required as $fld)
      {
          $this->validatorSchema[$fld]->setOption('required', true);
      }
      
      $this->widgetSchema['notes']->setAttribute("maxlength", 5000);
      $this->validatorSchema['notes']->setOption('max_length',5000);
      $this->validatorSchema['notes']->setMessage('max_length','Too long (%max_length% characters max.)&nbsp;');
      
      unset($this['created_at'],$this['updated_at'],$this["tax_due"],$this["due_date"],$this["payment_confirmed"],$this["payment_id"]);
      $this->mergePostValidator(new itrSubmissionFormValidatorSchema());      
      
      $this->disableCSRFProtection();
  }
  
  public function bind(array $taintedValues = null, array $taintedFiles = null) 
  {
      $this->handleBindForSubForm($taintedValues, "properties" );
      $this->handleBindForSubForm($taintedValues, "capitals1" );
      $this->handleBindForSubForm($taintedValues, "capitals2" );
      $this->handleBindForSubForm($taintedValues, "capitals3" );
      $this->handleBindForSubForm($taintedValues, "capitals4" );
      $this->handleBindForSubForm($taintedValues, "capitals5" );
      $this->handleBindForSubForm($taintedValues, "capitals6" );
      $this->handleBindForSubForm($taintedValues, "capitals7" );
      
      $this->handleBindForSubForm($taintedValues, "otherincome1" );
      $this->handleBindForSubForm($taintedValues, "otherincome2" );
      $this->handleBindForSubForm($taintedValues, "otherincome3" );      
      $this->handleBindForSubForm($taintedValues, "otherincome4" );      
      $this->handleBindForSubForm($taintedValues, "otherincome5" );      
     
      $this->handleBindForSubForm($taintedValues, "exemptions" );  
      $this->handleBindForSubForm($taintedValues, "itr_files" );  
      
      parent::bind($taintedValues, $taintedFiles);
  }
  
  public function saveEmbeddedForms($con = null, $forms = null) 
  {           
      if(null === $forms)
      {
          $this->handleSaveEmbeddedForSubForm("properties", "itr_property" );
          
          $this->handleSaveEmbeddedForSubForm("capitals1", "itr_securities" );
          $this->handleSaveEmbeddedForSubForm("capitals2", "itr_securities" );
          $this->handleSaveEmbeddedForSubForm("capitals3", "itr_securities" );
          $this->handleSaveEmbeddedForSubForm("capitals4", "itr_securities" );
          $this->handleSaveEmbeddedForSubForm("capitals5", "itr_securities" );
          $this->handleSaveEmbeddedForSubForm("capitals6", "itr_securities" );
          $this->handleSaveEmbeddedForSubForm("capitals7", "itr_securities" );
          
          $this->handleSaveEmbeddedForSubForm("otherincome1", "itr_other_income" );
          $this->handleSaveEmbeddedForSubForm("otherincome2", "itr_other_income" );
          $this->handleSaveEmbeddedForSubForm("otherincome3", "itr_other_income" );
          $this->handleSaveEmbeddedForSubForm("otherincome4", "itr_other_income" );
          $this->handleSaveEmbeddedForSubForm("otherincome5", "itr_other_income" );
          
          $this->handleSaveEmbeddedForSubForm("exemptions", "itr_exemption" );
          $this->handleSaveEmbeddedForSubForm("itr_files", "itr_file" );
          
      }
      parent::saveEmbeddedForms($con, $forms);
  }
  
  private function handleBindForSubForm(array $taintedValues = null, $sub_form_name)
  {
      if(isset($taintedValues[$sub_form_name]))
      {
          foreach ($taintedValues[$sub_form_name] as $key=>$form)
          {  
            if(false === $this->embeddedForms[$sub_form_name]->offsetExists($key))
            {
                $subform = $this->embeddedForms[$sub_form_name];

                $subform->addDetailRow($key, false);
                $this->embedForm($sub_form_name, $subform);
            }
          }
      }
  }
  
  private function handleSaveEmbeddedForSubForm($sub_form_name, $model_name)
  {
    $del_ids = array();
    $items = $this->getValue($sub_form_name);
    $forms = $this->embeddedForms;

    if($items)
    {
      foreach($this->embeddedForms[$sub_form_name]->embeddedForms as $name=>$form)
      {
          //if($form instanceof sfFormFieldSchema)
          {
              //$values = $form->getValue();
              $id     = $form['id'];

              if(!isset($items[$name]) && $id)
              {                 
                  if($id->getValue()) $del_ids[] = $id->getValue();
                  unset($forms[$sub_form_name][$name]);
              }
          }
      }           

      if(count($del_ids) ) 
      {
          $records = Doctrine::getTable($model_name)
                      ->createQuery('sd')
                      ->whereIn('sd.id', $del_ids)
                      ->execute();

          foreach($records as $record)
          { 
            $record->delete();
          }
          //$this->getObject ()->unlinkInDb ("subscription_song", $del_ids);
      }
    }
  }
  
}
