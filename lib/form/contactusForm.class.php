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
                        'country'=>new sfWidgetFormI18nChoiceCountry(),
                        'address1'=>new sfWidgetFormInputText(),
                        'address2'=>new sfWidgetFormInputText(),
                        'city'=>new sfWidgetFormInputText(),
                        'state'=>new sfWidgetFormInputText(),
                        'zip_code'=>new sfWidgetFormInputText(),                        
                        'message'   => new sfWidgetFormTextarea(),
                        'captcha'=>new sfWidgetFormReCaptcha(array("public_key"=>"6Le36L0SAAAAABGYUC3m06DuwX3FGmUZgZ-EHKR9")),
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
      $this->validatorSchema['captcha']        = new sfValidatorReCaptcha(array("private_key"=>"6Le36L0SAAAAANUU1B40huMwtC856kXTo1ftUfco"));
      
      $this->widgetSchema->setNameFormat('contactus[%s]');
    }
    
    public function getName() 
    {
        return "contactus";
    }
}

?>