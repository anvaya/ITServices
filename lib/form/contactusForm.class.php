<?php
/**
 * Description of contactForm
 *
 * @author Mrugendra Bhure
 */
class contactusForm extends sfForm
{
    public function setup()
    {
       $this->setCSRFFieldName('csrf_token');       
        
       $this->setWidgets
                (
                    array(                        
                        'sender_name'    => new sfWidgetFormInputText(),
                        'sender_email' => new sfWidgetFormInputText(),
                        'phone_number'=> new sfWidgetFormInputText(),
                        'country'=>new sfWidgetFormI18nChoiceCountry(array("add_empty"=>true)),/*
                        'address1'=>new sfWidgetFormInputText(),
                        'address2'=>new sfWidgetFormInputText(),
                        'city'=>new sfWidgetFormInputText(),
                        'state'=>new sfWidgetFormInputText(),
                        'zip_code'=>new sfWidgetFormInputText(),*/                        
                        'message'   => new sfWidgetFormTextarea(),
                        'captcha'=>new sfWidgetFormReCaptcha(array("public_key"=>"6LdTgeoSAAAAAGHl7n1voODBlFQDJwrx0mQnwPtO")),
                    )
                );
        
      $this->validatorSchema['sender_name']   = new sfValidatorString(array("required"=>true));            
      $this->validatorSchema['message']       = new sfValidatorString(array("required"=>true));      
      $this->validatorSchema['sender_email']   = new sfValidatorEmail(array("required"=>true));
      
      $this->validatorSchema['phone_number']   = new sfValidatorString(array("required"=>true));
      $this->validatorSchema['country']        = new sfValidatorI18nChoiceCountry(array("required"=>true));
      $this->validatorSchema['address1']       = new sfValidatorString(array("required"=>false));
      $this->validatorSchema['address2']       = new sfValidatorString(array("required"=>false));
      $this->validatorSchema['city']           = new sfValidatorString(array("required"=>false));
      $this->validatorSchema['state']           = new sfValidatorString(array("required"=>false));
      $this->validatorSchema['zip_code']       = new sfValidatorString(array("required"=>false));
      $this->validatorSchema['captcha']        = new sfValidatorReCaptcha(array("private_key"=>"6LdTgeoSAAAAAEFtxL50SOgy29JM2EIlDL8IxbEC"));
      
      $labels = array
              (
                "sender_name"=>"Your Name *",
                "sender_email"=>"Your Email *",
                "phone_number"=>"Phone No. *",
                "country"=>"Country *",
               /* "address1"=>"Address Line 1",
                "address2"=>"Address Line 2",
                "city"=>"City",
                "state"=>"State",
                "zip_code"=>"Zip/Postal Code",*/
                "message"=>"Your Query",                
              );
      
      foreach($labels as $field=>$label)
      {
          $this->widgetSchema[$field]->setLabel($label);
      }
      
      $this->widgetSchema->setNameFormat('contactus[%s]');
    }
    
    public function getName() 
    {
        return "contactus";
    }
}

?>