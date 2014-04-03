<?php
/**
 * Description of itrPropertyFormValidatorSchema
 *
 * @author Mrugendra Bhure
 */
class itrPropertyFormValidatorSchema extends sfValidatorSchema
{
    static $check_field = "details";
    
    protected function doClean($values)
    {
        $errorSchema = new sfValidatorErrorSchema($this);                               
         
        if(isset($values['owners']))
        {
            $values['owners'] = json_encode($values['owners']);            
        }
        
        if(isset($values['prev_year_receipt']))
        {
            $values['prev_year_receipt'] = json_encode($values['prev_year_receipt']);
        }
        else
        {
            $values['prev_year_receipt'] = json_encode(array());
        }
        
        if(isset($values['rent_details']))
        {
            if(!is_array($values['rent_details']))
            {
                $rent_details = array();
            }
            else
                $rent_details = $values['rent_details'];
            
            $rent_amount = 0;
            foreach($rent_details as $amt)
            {
                if(is_numeric($amt))
                {
                    $rent_amount += $amt;
                }
            }
            
            $values['rent_rcvd'] = $rent_amount;
            $values['rent_details'] = json_encode($values['rent_details']);
        }
        else
        {
            $values['rent_details'] = json_encode(array());
        }
        
        return $values;
    }    
}

?>