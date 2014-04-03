<?php
/**
 * Description of itrOtherIncomeCollectionForm
 *
 * @author Mrugendra Bhure
 */
class itrOtherIncomeCollectionForm extends sfForm
{
    const MASTER_MODEL = "itr_submission";
    static $form_class = "itr_other_incomeForm";
    static $details_class = "itr_other_income";
    static $validator_class = "itrOtherIncomeCollectionValidatorSchema";
    
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
            $details = itr_other_incomeTable::getInstance()
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
        /* @var $detail itr_property */
        $detail->setItrSubmission($master);
        $detail->setCategoryId($category_id);
        
        $form = new self::$form_class($detail);                
                
        $this->embedForm($key, $form);
        return $this->embeddedForms[$key];
    }
}

?>