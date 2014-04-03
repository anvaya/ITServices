<?php
/**
 * Description of itrSecuritiesFormValidatorSchema.class.php
 *
 * @author Mrugendra Bhure
 */
class itrSecuritiesFormPreValidatorSchema extends sfValidatorSchema
{       
    protected function doClean($values)
    {
        $date_sale = $values['date_sale'];
        if($date_sale)
        {            
            $date_parts = explode(" ", $date_sale,5);
            unset($date_parts[4]);
            $date = strtotime( implode(" ",$date_parts) );            
            
            $values['date_sale'] = array
            (
                "year"=>date('Y',$date),
                "month"=>date('m',$date),
                "day"=>date('d',$date)
            );
        }        
    }    
}

?>