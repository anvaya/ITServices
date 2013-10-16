<?php
/**
 * Helper class to generate common form widgets
 *
 * @author Mrugendra Bhure
 */
class widgetHelper 
{
    const WIDGET_DATE = 0;
    const WIDGET_DATETIME = 1;
    const WIDGET_TIME = 2;
    const WIDGET_ACTIVE_PROGRAM_YEAR = 3;
    const WIDGET_ANSWER_TYPE = 4;    
    const WIDGET_QUESTION_CATEGORY = 5;
    const WIDGET_SURVEY_STATUS = 6;
    
    /**
     * Returns commonly used widget
     * @param int $widget_type One of the supported widget type. @see widgetHelper
     * @param array $options Array of options to pass to the widget.
     * @expectedException invalidArgumentException
     * @return sfWidgetForm Creates and returns a new widget instance.
     */
    public static function getWidget($widget_type, $options = array())
    {                
        switch($widget_type)
        {
            case self::WIDGET_DATE:                           
                $options['culture'] = sfContext::getInstance()->getUser()->getCulture();
                return new sfWidgetFormJQueryDate($options);
                break;
            
            case self::WIDGET_ANSWER_TYPE:
                $options["choices"] = questionTable::$ANSWER_TYPES;
                return new sfWidgetFormChoice($options);
                break;                    
            
            case self::WIDGET_QUESTION_CATEGORY:
                $options["order_by"] = array("category_name","asc");
                return new sfWidgetFormDoctrineChoice($options);
                break;
            
            case self::WIDGET_SURVEY_STATUS:
                $options["choices"] = surveyTable::$SURVEY_STATUS_LIST;
                return new sfWidgetFormChoice($options);
                break;                    
                
        }
        throw new InvalidArgumentException("Widget of the type $widget_type is not supported.");
    }
    
    /**
     * Returns commonly used validator
     * @param int $validator_type One of the supported widget type. @see widgetHelper
     * @param array $options Array of options to pass to the validator widget.
     * @expectedException invalidArgumentException
     * @return sfValidatorBase Creates and returns a new validator instance.
     */
    public static function getValidator($validator_type, $options = array())
    {
        switch($validator_type)
        {
            case self::WIDGET_ANSWER_TYPE:
                $options['choices'] = array_keys(questionTable::$ANSWER_TYPES);
                return new sfValidatorChoice($options);
                break;
            case self::WIDGET_SURVEY_STATUS:
                $options['choices'] = array_keys(surveyTable::$SURVEY_STATUS_LIST);
                return new sfValidatorChoice($options);
                break;
        }
        throw new InvalidArgumentException("Validator of the type $validator_type is not supported.");
    }      
    
    
}

?>