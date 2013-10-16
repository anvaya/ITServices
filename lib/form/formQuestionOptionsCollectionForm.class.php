<?php
/**
 * Collection of Options for the question bank - Subform for the question bank form.
 *
 * @author Mrugendra Bhure
 */
class formQuestionOptionsCollectionForm extends sfForm
{
    const MASTER_MODEL = "form_question";
    
    public function configure() 
    {
        if(!$master = $this->getOption(self::MASTER_MODEL))
        {
            throw new InvalidArgumentException('You must provide a '.self::MASTER_MODEL.' object');
        }       
        
        $details=array();
        
        /* @var $master question_bank */
        if($master->getId()>0)
        {
            $details = $master->getFormquestionOption();
        }        
        
        foreach($details as $key=>$value)
        {
            $form = new formquestion_optionForm($value);
            $this->embedForm($key, $form);
        }
        
        parent::configure();
        $this->mergePostValidator(new formquestionOptionsValidatorSchema());
    }
    
    public function addDetailRow($key)
    {
        $detail = new formquestion_option();
        $master = $this->getOption(self::MASTER_MODEL);
        $detail->setFormQuestion($master);    
        
        $form = new formquestion_optionForm($detail);        
        
        $form->setDefault('display_order', $key+1);
        
        $this->embedForm($key, $form);
        return $this->embeddedForms[$key];
    }
}

?>