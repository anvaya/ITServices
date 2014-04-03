<?php
/**
 * Description of itrSecuritiesFormValidatorSchema.class.php
 *
 * @author Mrugendra Bhure
 */
class itrOtherIncomeFormValidatorSchema extends sfValidatorSchema
{        
        
    protected function doClean($values)
    {
        $errorSchema = new sfValidatorErrorSchema($this);                               
                
        if(isset($values['date_rcvd']) && $values['date_rcvd'])
        {
            $time = $values['date_rcvd'];
            $date_parts = explode(" ", $time,5);                    

            $validator = new sfValidatorDate(array("required"=>false));
            try 
            {           
                unset($date_parts[4]);                
                //$date = strtotime( implode(" ",$date_parts) );
                
                $date = trim(preg_replace('/\(.*\)/', "",$time));
                $values['date_rcvd'] = $validator->clean($date);
            }
            catch (Exception $ex) 
            {
                $errorSchema->addError(new sfValidatorError($this, $ex->getMessage(), "date_rcvd"));
            }
        }
        
        
        return $values;
    }    
}

?>