<?php
/**
 * Description of itrPropertyCollectionForm
 *
 * @author Mrugendra Bhure
 */
class itrPropertyCollectionForm extends sfForm
{
    const MASTER_MODEL = "itr_submission";
    static $form_class = "itr_propertyForm";
    static $details_class = "itr_property";
    static $validator_class = "itrPropertyCollectionValidatorSchema";
    
    public function configure() 
    {
        if(!$master = $this->getOption(self::MASTER_MODEL))
        {
            throw new InvalidArgumentException('You must provide a '.self::MASTER_MODEL.' object');
        }       
        
        $details=array();
        
        /* @var $master itr_submission */
        //if($master->getId()>0)
        {
            $details = $master->getItrProperty();
        }        
        
        foreach($details as $key=>$value)
        {
            $form = new self::$form_class($value);
            $this->embedForm($key, $form);
        }
        
        parent::configure();
        $this->mergePostValidator(new  self::$validator_class() );
    }
    
    public function addDetailRow($key)
    {
        $detail = new self::$details_class();
        $master = $this->getOption(self::MASTER_MODEL);
        /* @var $detail itr_property */
        $detail->setItrSubmission($master);
        
        $form = new self::$form_class($detail);                
                
        $this->embedForm($key, $form);
        return $this->embeddedForms[$key];
    }
}

?>