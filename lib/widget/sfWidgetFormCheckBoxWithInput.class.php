<?php
/**
 * Description of sfWidgetFormCheckBoxWithInput
 *
 * @author Anvaya Technologies
 */
class sfWidgetFormCheckBoxWithInput extends sfWidgetForm
{
    public function configure($options = array(), $attributes = array()) 
    {        
        $this->addRequiredOption('input_widget_type');
        $this->addRequiredOption('input_widget_options');
    }
    
    public function render($name, $value = null, $attributes = array(), $errors = array()) 
    {
        /*
        $base_widget = new sfWidgetformch
        $input_type = $this->getOption("input_widget_type");
        if($input_type==questionTable::ANSWER_TYPE_TEXT)
        {
            $input_widget = new sfWidgetFormInputText();
        }
        else
        {
           $choices = $this->getOption("input_widget_options");
           $input_widget = new sfWidgetFormChoice(array("choices"=>$choices));
        }
        */
        
    }
}

?>