<?php
/**
 * Description of reminderFormValidatorSchema
 *
 * @author Mrugendra Bhure
 */
class reminderFormValidatorSchema extends sfValidatorSchema
{
    protected function doClean($values)
    {
        $errorSchema = new sfValidatorErrorSchema($this);
        
        if(trim($values['alert_type']) == "1" && $values['survey_id'] == "")
        {
            $errorSchemaLocal = new sfValidatorErrorSchema($this);
            $errorSchemaLocal->addError(new sfValidatorError($this,'required'), 'survey');
            if(count($errorSchemaLocal))
                $errorSchema->addError($errorSchemaLocal, 'survey_id');
        }
          
        if(trim($values['alert_type']) == "2" && $values['submission_form_id'] == "")
        {
            $errorSchemaLocal = new sfValidatorErrorSchema($this);
            $errorSchemaLocal->addError(new sfValidatorError($this,'required'), 'Form');
            if(count($errorSchemaLocal))
                $errorSchema->addError($errorSchemaLocal, 'submission_form_id');
        }
                
        
        if(count($errorSchema)>0)
            throw new sfValidatorErrorSchema($this, $errorSchema);
        if(trim($values['alert_type']) == "1")
          unset($values['submission_form_id']);
        else if(trim($values['alert_type']) == "2")
          unset($values['survey_id']);
        else {
          unset($values['submission_form_id']);
          unset($values['survey_id']);
        }
        return $values;
    }
}

?>