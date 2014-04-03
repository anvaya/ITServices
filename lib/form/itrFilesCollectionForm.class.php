<?php
/**
 * Description of itrOtherIncomeCollectionForm
 *
 * @author Mrugendra Bhure
 */
class itrFilesCollectionForm extends sfForm
{
    const MASTER_MODEL = "itr_submission";
    static $form_class = "itr_fileForm";
    static $details_class = "itr_file";
    static $validator_class = "itrFilesCollectionValidatorSchema";
    
    public function configure() 
    {
        if(!$master = $this->getOption(self::MASTER_MODEL))
        {
            throw new InvalidArgumentException('You must provide a '.self::MASTER_MODEL.' object');
        }               
                
        $details=array();
        
        /* @var $master itr_submission */
        if($master->getId()>0)
        {
            $details = itr_fileTable::getInstance()
                        ->createQuery()                        
                        ->addWhere('submission_id = ?', $master->getId())
                        ->execute();                            
        }                
        
        if(count($details)==0)
        {
            $details = new Doctrine_Collection("itr_file");
            $new_item = new itr_file();
            $new_item->setItrSubmission($master);
            $details->add($new_item);
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