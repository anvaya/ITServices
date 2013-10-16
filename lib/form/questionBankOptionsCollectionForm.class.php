<?php
/**
 * Collection of Options for the question bank - Subform for the question bank form.
 *
 * @author Mrugendra Bhure
 */
class questionBankOptionsCollectionForm extends sfForm
{
    const MASTER_MODEL = "question_bank";
    
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
            $details = $master->getQuestionOption();
        }        
        
        foreach($details as $key=>$value)
        {
            $form = new question_optionForm($value);
            $this->embedForm($key, $form);
        }
        
        parent::configure();
        $this->mergePostValidator(new questionBankOptionsValidatorSchema());
    }
    
    public function addDetailRow($key)
    {
        $detail = new question_option();
        $master = $this->getOption(self::MASTER_MODEL);
        $detail->setQuestionBank($master);    
        
        $form = new question_optionForm($detail);        
        
        $form->setDefault('display_order', $key+1);
        
        $this->embedForm($key, $form);
        return $this->embeddedForms[$key];
    }
}

?>