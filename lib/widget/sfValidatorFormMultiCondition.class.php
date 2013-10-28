<?php

/**
 * Description of sfValidatorFormMultiCondition
 *
 * @author Mrugendra Bhure
 */
class sfValidatorFormMultiCondition extends sfValidatorBase
{
    public function configure($options = array(), $messages = array()) 
    {
        $this->addRequiredOption('value_validator');
        $this->addOption('field_type','text');
        $this->addOption("add_is_empty", false);
        parent::configure($options, $messages);
    }
    
    public function doClean($value)
    {
        $value_validator = $this->getOption('value_validator');
        
        if(!isset($value['operator']))
        {
            $value_return = $value_validator->clean($value);
            return array("operator"=>null, 'value'=>$value_return );
        }
        else
        {
            if($value['operator']==sfWidgetFormFilterMultiCondition::IS_EMPTY)
            {
               $value_return = null;            
            }        
            elseif(isset($value['value']))
            {
                $value_return = $value_validator->clean($value['value']);
            }
            else
            {
                $value_return = $value_validator->clean(null);
            }
        }
        
        return array("operator"=>$value['operator'], 'value'=>$value_return );
    }
}

?>