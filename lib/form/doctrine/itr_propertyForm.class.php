<?php

/**
 * itr_property form.
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class itr_propertyForm extends Baseitr_propertyForm
{
  public function configure()
  {
      $this->validatorSchema['remove'] = new sfValidatorPass();
      $this->mergePostValidator(new itrPropertyFormValidatorSchema());
      $this->validatorSchema['owners'] = new sfValidatorPass();     
      $this->validatorSchema['prev_year_receipt'] = new sfValidatorPass();     
      $this->validatorSchema['rent_details'] = new sfValidatorPass();
      $this->mergePostValidator(new sfValidatorSchemaCompare("loan_amount", sfValidatorSchemaCompare::GREATER_THAN_EQUAL , "loan_repaid", array(), array("invalid"=>"Loan Amount must be > than loan repaid.") ));
      unset($this['submission_id']);
  }
}
