<?php
/**
 * Description of questionBankOptionsValidatorSchema
 *
 * @author Mrugendra Bhure
 */
class questionBankOptionsValidatorSchema extends sfValidatorSchema
{
    protected function doClean($values)
    {
        $errorSchema = new sfValidatorErrorSchema($this);                               
                
        foreach($values as $key=>$value)
        {
            $errorSchemaLocal = new sfValidatorErrorSchema($this);
            
            if($value['remove']=="0") //Record needs to be removed
            {
                unset($values[$key]);
            }                                   
            elseif($value['option_text']=='' && !$value['id'])
            {
                unset($values[$key]);
            }
            elseif($value['option_text']=='' && $value['id'])
            {
                $errorSchemaLocal->addError(new sfValidatorError($this,'required'), 'option_text');
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