<?php
/**
 * Description of itrSecuritiesFormValidatorSchema.class.php
 *
 * @author Mrugendra Bhure
 */
class itrSecuritiesFormValidatorSchema extends sfValidatorSchema
{        
    const check_field = 'purchase_info';
    const check_field2 = 'addon_costs';
    const check_field3 = 'addon_expenses';
    
    protected function doClean($values)
    {
        $errorSchema = new sfValidatorErrorSchema($this);                               
        
        $purchase_info = array();
        $qty_purchased = 0;
        $qty_sold = $values['quantity_sold'];
        
        if(isset($values[self::check_field]))
        {
            $purchase_info = $values['purchase_info'];
            $values[self::check_field] = json_encode($values[self::check_field]);
        }
        else
        {
            $values[self::check_field] = json_encode(array());
        }
        
        if(isset($values[self::check_field2]))
        {
            $costs_info = $values[self::check_field2];
            $values[self::check_field2] = json_encode($values[self::check_field2]);
        }
        else
        {
            $values[self::check_field2] = json_encode(array());
        }
        
        if(isset($values[self::check_field3]))
        {
            $expenses_info = $values[self::check_field3];
            $values[self::check_field3] = json_encode($values[self::check_field3]);
        }
        else
        {
            $values[self::check_field3] = json_encode(array());
        }
        
        if(isset($values['date_sale']) && $values['date_sale'] && $values['details'])
        {
            $time = $values['date_sale'];                        
            if(strpos($time, '/')>0)
            {                
                $time = str_replace("/", "-", $time);
            }
            
            $date_parts = explode(" ", $time,5);                    
            

            $validator = new sfValidatorDate(array("required"=>false));
            try 
            {           
                unset($date_parts[4]);
                //$date = strtotime( implode(" ",$date_parts) );
                $date = trim(preg_replace('/\(.*\)/', "",$time));
                $values['date_sale'] = $validator->clean($date);
                
                $compare_validator = new sfValidatorSchemaCompare("date_sale", sfValidatorSchemaCompare::GREATER_THAN_EQUAL , "date_purchase", array(), array("invalid"=>"Must be after purchase date" ) );
                
                if(!is_array($purchase_info)) 
                {
                    $purchase_info = array();
                }
                
                foreach($purchase_info as $prow)
                {
                    if($prow['quantity'])
                    {
                        $qty_purchased += $prow['quantity'];
                    }
                    
                    if($prow['date'])
                    {
                        $time = $prow['date'];
                        /*$date_parts = explode(" ", $time,5);  
                        unset($date_parts[4]);                        
                        $date = strtotime( implode(" ",$date_parts) );*/
                        
                        $date = trim(preg_replace('/\(.*\)/', "",$time));                         
                        $purchase_date = $validator->clean($date);                        
                        $compare_validator->clean(array("date_sale"=>$values['date_sale'],"date_purchase"=>$purchase_date));                        
                    }
                }
            }
            catch (Exception $ex) 
            {
                $errorSchema->addError(new sfValidatorError($this, $ex->getMessage()), "date_sale");
            }
            
            if($qty_purchased < $qty_sold)
            {
                $errorSchema->addError(new sfValidatorError($this, 'Qty sold must be less or equal to qty purchased.'), "quantity_sold");
            }
        }
        else
        {
            $values['date_sale'] = "";
        }
        
        
        
        if($errorSchema->count())
        {
            throw $errorSchema;
        }
        
        return $values;
    }    
}

?>