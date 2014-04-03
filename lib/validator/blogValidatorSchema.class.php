<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of blogValidatorSchema
 *
 * @author Mrugendra Bhure
 */
class blogValidatorSchema extends sfValidatorSchema
{
     protected function doClean($values)
    {
        $errorSchema = new sfValidatorErrorSchema($this);                               
                
        $values['author_id'] = sfContext::getInstance()->getUser()->getGuardUser()->getId();
        
        if(count($errorSchema)>0)
            throw new sfValidatorErrorSchema($this, $errorSchema);
        
        return $values;
    }
}

?>