<?php
/**
 * Description of backendItrSubmissionForm
 *
 * @author Mrugendra Bhure
 */
class backendItrSubmissionForm extends Baseitr_submissionForm
{
    public function configure()
    {
      $choices = array(            
            ""=>"Pending",
            "1"=>"Processing",
            "2"=>"Awaiting Customer Reply",
            "3"=>"Filed"
                );
        
      $this->widgetSchema['status'] = new sfWidgetFormChoice(array("choices"=>$choices));
      $this->validatorSchema['status'] = new sfValidatorChoice(array("choices"=>array_keys($choices),"required"=>false));
      $this->useFields(array("notes","status"));//,"tax_due","due_date","payment_confirmed"));
        
      $this->widgetSchema['notes']->setAttribute("maxlength", 5000);
      $this->validatorSchema['notes']->setOption('max_length',5000);
      $this->validatorSchema['notes']->setMessage('max_length','Too long (%max_length% characters max.)&nbsp;');      
      
      
     
      
    }
}

?>