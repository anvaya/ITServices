<?php
/**
 * Description of sfWidgetFormMultiCondition
 *
 * @author Mrugendra Bhure
 */
class sfWidgetFormFilterMultiCondition extends sfWidgetForm
{
    const BEGINS_WITH  = "BW";
    const ENDS_WITH    = "EW";
    const CONTAINS     = "C";
    const NOT_CONTAIN  = "NC";
    const EQUAL     = "EQ";
    const NOT_EQUAL = "NEQ";
    const GREATER_THAN = ">";
    const LESS_THAN    = "<";
    const GREATER_THAN_EQUAL = ">=";
    const LESS_THAN_EQUAL = "<=";
    const BETWEEN = "BTW";
    const NOT_BETWEEN = "NBTW";
    const IS_EMPTY = "IE";
    
    public function configure($options = array(), $attributes = array()) 
    {        
        $this->addRequiredOption('value_widget');     
        $this->addOption("field_type", 'text');  
        $this->addOption("add_is_empty", false);
    }
    
    public function needsMultipartForm() 
    {
        return $this->getOption('value_widget')->needsMultipartForm();
    }
    
    public function getValueWidget()
    {
        return $this->getOption('value_widget');
    }
    
    public function render($name, $value = null, $attributes = array(), $errors = array()) 
    {
        $master_widget = $this->getOption('value_widget');
        /* @var $master_widget sfWidgetForm */
        
        $numeric_choices = array
        (
            self::EQUAL=>__("Equal To"),
            self::GREATER_THAN=>__("Greater Than"),
            self::LESS_THAN=>__("Less Than"),
            self::GREATER_THAN_EQUAL=>__("Greater or Equal"),
            self::LESS_THAN_EQUAL=>__("Less Than or Equal"),
            self::NOT_EQUAL=>__("Not Equal To"),
        );
        
        $date_choices = array
        (
            self::BETWEEN=>__("Between"),
            self::EQUAL=>__("Equal To"),
            self::NOT_EQUAL=>__("Not Equal To"),
            self::GREATER_THAN=>__("Greater Than"),
            self::LESS_THAN=>__("Less Than"),
            self::GREATER_THAN_EQUAL=>__("Greater or Equal"),
            self::LESS_THAN_EQUAL=>__("Less or Equal"),
            self::NOT_BETWEEN=>__("Not Between"),
        );
        
        
        $foreign_choices = array(
            self::EQUAL=>__("Equal To"),
            self::NOT_EQUAL=>__("Not Equal To"),
        );
        
        if($this->getOption('add_is_empty'))
        {
            $foreign_choices[self::IS_EMPTY] = __("Is Empty");
        }
        
        $text_choices = array
        (
            self::CONTAINS=>__("Contains"),
            self::NOT_CONTAIN=>__("Does not Contain"),
            self::BEGINS_WITH=>__("Begins With"),
            self::ENDS_WITH=>__("Ends With"),
            self::EQUAL=>__("Equals To"),
            self::NOT_EQUAL=>__("Not Equal To"),
        );
        
        switch($this->getOption('field_type'))
        {
            case "numeric":
                $choices = $numeric_choices;
                break;
            case "date":
                $choices = $date_choices;
                break;
            case "foreign":
                $choices = $foreign_choices;
                break;
            default:
                $choices = $text_choices;
                break;
        }                
        
        $choice_widget = new sfWidgetFormChoice(array("choices"=>$choices));
        
        $operator_value = $field_value = null;
        
        if(isset($value['operator']))
            $operator_value = $value['operator'];
        if(isset($value['value']))
            $field_value = $value['value'];
        
        $class="";
        if(is_array($field_value))
        {
            if(isset($field_value['text']))
            {
                if(strlen($field_value['text'])) $class='filled';
            }
            elseif(isset($field_value['from']))
            {
                if(is_array($field_value['from']))
                {
                    if(strlen(implode("", $field_value['from'] ))) $class = 'filled';
                }
                elseif(strlen($field_value['from'])) $class='filled';
            }
            elseif(isset($field_value['to']))
            {
                if(is_array($field_value['to']))
                {
                    if(strlen(implode("", $field_value['to'] ))) $class = 'filled';
                }
                elseif(strlen($field_value['to'])) $class='filled';
            }
        }
        elseif($field_value)
        {
            $class ='filled';
        }
            
        if(strlen($class))
            $attributes['class']=$class;
        
        if($operator_value || $class)
        {
            if($operator_value==self::IS_EMPTY) $attributes["class"]="filled";
        }
        
        $operator_render = $choice_widget->render($name."[operator]", $operator_value , $attributes, $errors);               
        
        $value_render  = $master_widget->render($name."[value]", $field_value , $attributes, $errors);        
        $separator = ($this->getOption('field_type')=='date')?'<br />':'&nbsp;';              
        
        
        return $operator_render.$separator.$value_render;
    }  
    
    
    public static function addColumnQuery(Doctrine_Query $query, $column, $value, $col_type='text', $use_or_where=false)
    {
        if(!is_array($column))
        {
            if(strpos($column,".")>0)
                $root_alias= "";
            else
                $root_alias = $query->getRootAlias ().".";
        }
        else
            $root_alias = $query->getRootAlias ().".";
        
        if(isset($value['value']))
        {    
            if(is_array($value['value']))
            {
                if(isset($value['value']['is_empty']))
                {   
                    if($use_or_where)
                    {
                        $query->orWhere("$root_alias$column IS NULL" );
                    }
                    else                    
                    {
                        $query->addWhere("($root_alias$column IS NULL or $root_alias$column='')" );
                    }
                    return;
                }
            }
        }        
        
        if($col_type=='text')
        {
            if(isset($value['value']))
            {
                if(is_array($value['value']))
                {
                    $field_value = $value['value']['text'];
                }
                else
                {
                    $field_value = $value['value'];
                }
            }
            #$field_value = isset($value['value']['text'])?$value['value']['text']:'' ;

            if(isset($value['operator']) && strlen($field_value)>0)
            {
                $operator = $value['operator'];
                switch($operator)
                {
                    case self::CONTAINS:
                        
                        $field_value = str_replace("[", "[[]", $field_value);
                        $field_value = str_replace("_", "[_]", $field_value);
                        $field_value = str_replace("%", "[%]", $field_value);                                                               
                        
                        $condition_operator = "like";
                        $condition_value    = '%'.$field_value.'%';
                        
                        break;
                    case self::NOT_CONTAIN:                  
                        
                        $field_value = str_replace("[", "[[]", $field_value);
                        $field_value = str_replace("_", "[_]", $field_value);
                        $field_value = str_replace("%", "[%]", $field_value);
                        
                        $condition_operator = "not like";
                        $condition_value    = '%'.$field_value.'%';                        
                        
                        break;
                        
                    case self::ENDS_WITH:
                        
                        $field_value = str_replace("[", "[[]", $field_value);
                        $field_value = str_replace("_", "[_]", $field_value);
                        $field_value = str_replace("%", "[%]", $field_value);
                        
                        $condition_operator = "like";
                        $condition_value    = '%'.$field_value;
                        
                        
                        break;
                        
                    case self::BEGINS_WITH:
                        
                        $field_value = str_replace("[", "[[]", $field_value);
                        $field_value = str_replace("_", "[_]", $field_value);
                        $field_value = str_replace("%", "[%]", $field_value);
                        
                        $condition_operator = "like";
                        $condition_value    = $field_value.'%';                        
                        
                        break;              
                        
                    case self::EQUAL:
                        
                        $condition_operator = "=";
                        $condition_value    = $field_value;                                                
                        
                        break;              
                    case self::NOT_EQUAL:
                        
                        $condition_operator = "<>";
                        $condition_value    = $field_value;                                                
                        
                        break;
                }
                
                
                if(is_array($column))
                {
                    $out = "";
                    $params = array();
                    foreach($column as $col)
                    {
                        if(strlen($out)) $out.= $use_or_where?" OR ":" AND ";
                        $out .= "(".$root_alias."$col $condition_operator ?)";
                        $params[] = $condition_value;
                    }
                    $query->addWhere("(".$out.")", $params );
                }
                else
                {
                    if($use_or_where)
                        $query->orWhere ("($root_alias$column $condition_operator ?)", $condition_value);
                    else
                        $query->addWhere ("$root_alias$column $condition_operator ?", $condition_value);
                }
                    
                
                
                
            }
        }
        elseif($col_type=='foreign')
        {
            if(is_array($value['value']))
            {
                $field_value = $value['value']['text'];
            }
            elseif($value['operator']==self::IS_EMPTY)
            {
                $field_value = '0';
            }
            else
                $field_value = isset($value['value'])?$value['value']:'';
            
            if(isset($value['operator']) && strlen($field_value)>0)
            {
                $operator = $value['operator'];
                switch($operator)
                {
                    case self::IS_EMPTY:
                        $query->addWhere("($root_alias$column is null or $root_alias$column='')");
                        break;
                    case self::EQUAL:
                        $query->addWhere("$root_alias$column = ?", $field_value );
                        break;
                    case self::NOT_EQUAL:     
                        $query->addWhere("($root_alias$column IS NULL OR $root_alias$column <> ?".")", $field_value );
                        break;
                }
            }
        }
        elseif($col_type=='numeric')
        {
            if(is_array($value['value']))
            {
                $field_value = $value['value']['text'];
            }
            else
                $field_value = isset($value['value'])?$value['value']:'';            
                        
            if(isset($value['operator']) && strlen($field_value)>0)
            {
                $operator = $value['operator'];
                switch($operator)
                {
                    case self::EQUAL:
                        $query->addWhere("$root_alias$column = ?", $field_value );
                        break;
                    case self::NOT_EQUAL:     
                        $query->addWhere("($root_alias$column IS NULL OR $root_alias$column <> ?".")", $field_value );
                        break;
                    case self::GREATER_THAN:

                        $query->addWhere("$root_alias$column > ?", $field_value );
                        break;                    
                    case self::LESS_THAN:
                        $query->addWhere("$root_alias$column < ?", $field_value );
                        break;
                    case self::GREATER_THAN_EQUAL:                    
                        $query->addWhere("$root_alias$column >= ?", $field_value );
                        break;
                    case self::LESS_THAN_EQUAL:
                        $query->addWhere("$root_alias$column <= ?", $field_value );
                        break;
                }
            }
        }
        elseif($col_type=='date')
        {
            $field_value = isset($value['value'])?$value['value']:'';
            
            if(is_array($field_value))
            {
                $from_date   = isset($field_value['from'])?$field_value['from']:'';
                $to_date     = isset($field_value['to'])?$field_value['to']:'';
            }
            else
            {
                $from_date   = $field_value;
                $to_date     = '';                
            }
            
            $operator    = isset($value['operator'])?$value['operator']:'';
            
            $single_value_check = true;
            
            if( strlen($from_date)>0 && strlen($to_date)>0 )
            {
                switch($operator)
                {
                    case self::BETWEEN:
                        $single_value_check = false;
                        $query->addWhere("($root_alias$column between ? AND ?)", array($from_date, $to_date) );
                        break;
                    case self::NOT_BETWEEN:
                        $query->addWhere("($root_alias$column not between ? AND ?)", array($from_date, $to_date) );
                        $single_value_check = false;
                        break;                        
                }                
            }
            
            //Just in case people use 'to' column for single value
            if(strlen($from_date)==0 && strlen($to_date)>0) $from_date = $to_date; 
            
            if($single_value_check && strlen($from_date)>0)
            {
                $q = Doctrine_Manager::getInstance()->getCurrentConnection();        
                
                if(get_class($q)=="Doctrine_Connection_SqlSrv")
                {
                    $cond = "datediff(d,$root_alias$column,?)";
                    
                    switch($operator)
                    {                    
                        case self::EQUAL:
                            $query->addWhere($cond."=0", $from_date );
                            break;
                        case self::NOT_EQUAL:     
                            $query->addWhere($cond."<>0", $from_date );
                            break;
                        case self::GREATER_THAN:
                        case self::NOT_BETWEEN:
                            $query->addWhere($cond."<0", $from_date );
                            break;                    
                        case self::LESS_THAN:
                            $query->addWhere($cond.">0", $from_date );
                            break;
                        case self::GREATER_THAN_EQUAL:
                        case self::BETWEEN:
                            $query->addWhere($cond."<=0", $from_date );
                            break;
                        case self::LESS_THAN_EQUAL:
                            $query->addWhere($cond.">=0", $from_date );
                            break;
                    }
                }
                else
                {
                    switch($operator)
                    {                    
                        case self::EQUAL:
                            $query->addWhere($cond."=0", $from_date );
                            break;
                        case self::NOT_EQUAL:     
                            $query->addWhere($cond."<>0", $from_date );
                            break;
                        case self::GREATER_THAN:
                        case self::NOT_BETWEEN:
                            $query->addWhere($cond.">0", $from_date );
                            break;                    
                        case self::LESS_THAN:
                            $query->addWhere($cond."<0", $from_date );
                            break;
                        case self::GREATER_THAN_EQUAL:
                        case self::BETWEEN:
                            $query->addWhere($cond.">=0", $from_date );
                            break;
                        case self::LESS_THAN_EQUAL:
                            $query->addWhere($cond."<=0", $from_date );
                            break;
                    }
                }
                
                
            }
        }
        
    }
    
    public function getJavaScripts() 
    {   
        return array();
        return $this->getOption('value_widget')->getJavaScripts();        
    }
    
    public function getStylesheets() 
    {
        return array();
        return $this->getOption('value_widget')->getStylesheets();
    }
}

?>