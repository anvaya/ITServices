<?php
/**
 * Description of itrSubmissionFormValidatorSchema
 *
 * @author Mrugendra Bhure
 */
class itrSubmissionFormValidatorSchema 
extends sfValidatorSchema
{
    public function clean($values) 
    {
        $values['member_id'] = sfContext::getInstance()->getUser()->getGuardUser()->getId();
        return $values;
    }
}

?>