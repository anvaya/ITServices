<?php
/**
 * Description of itrSecuritiesCollectionForm
 *
 * @author Mrugendra Bhure
 */
class itrSecuritiesCollectionForm extends sfForm
{
    const MASTER_MODEL = "itr_submission";
    static $form_class = "itr_securitiesForm";
    static $details_class = "itr_securities";
    static $validator_class = "itrSecuritiesCollectionValidatorSchema";
    
    public function configure() 
    {
        if(!$master = $this->getOption(self::MASTER_MODEL))
        {
            throw new InvalidArgumentException('You must provide a '.self::MASTER_MODEL.' object');
        }       
        
        if(!$category_id = $this->getOption('category_id'))
        {
            throw new InvalidArgumentException('You must provide a category_id');
        }       
        
        $details=array();
        
        /* @var $master itr_submission */
        if($master->getId()>0)
        {
            $details = itr_securitiesTable::getInstance()
                        ->createQuery()
                        ->addWhere('category_id = ?', $category_id)
                        ->addWhere('submission_id = ?', $master->getId())
                        ->execute();            
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
        $category_id = $this->getOption('category_id');
        
        $detail = new self::$details_class();
        $master = $this->getOption(self::MASTER_MODEL);
        /* @var $detail itr_securities */
        $detail->setItrSubmission($master);
        $detail->setCategoryId($category_id);
        
        $form = new self::$form_class($detail);                
                
        $this->embedForm($key, $form);
        return $this->embeddedForms[$key];
    }
}

?>