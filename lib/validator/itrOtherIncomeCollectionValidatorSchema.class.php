<?php
/**
 * Description of itrOtherIncomeCollectionValidatorSchema
 *
 * @author Mrugendra Bhure
 */
class itrOtherIncomeCollectionValidatorSchema extends sfValidatorSchema
{
    static $check_field = "amount";
    
    protected function doClean($values)
    {
        $errorSchema = new sfValidatorErrorSchema($this);                               
                
        foreach($values as $key=>$value)
        {
            $errorSchemaLocal = new sfValidatorErrorSchema($this);
            
            if($value['remove']=="1") //Record needs to be removed
            {
                unset($values[$key]);
            }                                   
            elseif($value[self::$check_field]=='' && !$value['id'])
            {
                unset($values[$key]);
            }
            elseif($value[self::$check_field]=='' && $value['id'])
            {
                unset($values[$key]);
                //$errorSchemaLocal->addError(new sfValidatorError($this,'required'), 'option_text');
            }
            else
            {                                
                unset($values[$key]['remove']);                
            }              
                        
            if(count($errorSchemaLocal))
                $errorSchema->addError($errorSchemaLocal, (string) $key);
        }        
        
        if(count($errorSchema)>0)
            throw new sfValidatorErrorSchema($this, $errorSchema);
        
        return $values;
    }
}

?>