<?php
/**
 * Description of surveyDataValidatorSchema
 *
 * @author Mrugendra Bhure
 */
class RegisterSubFormValidatorSchema extends sfValidatorSchema
{
    protected function doClean($values)
    {
        $errorSchema = new sfValidatorErrorSchema($this);
        
        /*if(trim($values['yourinformation_10_1']) == "" && $values['yourinformation_11_7'] == "")
        {
            $errorSchemaLocal = new sfValidatorErrorSchema($this);
            $errorSchemaLocal->addError(new sfValidatorError($this,'required'), 'phone');
            if(count($errorSchemaLocal))
                $errorSchema->addError($errorSchemaLocal, 'yourinformation_10_1');
        }*/
          
        if(count($errorSchema)>0)
            throw new sfValidatorErrorSchema($this, $errorSchema);
        
        return $values;
    }
}

?>