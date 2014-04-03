<?php

/**
 * itr_securities form.
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class itr_securitiesForm extends Baseitr_securitiesForm
{
  public function configure()
  {
      $this->validatorSchema['remove'] = new sfValidatorPass();
      $this->validatorSchema['purchase_info'] = new sfValidatorPass();                 
      $this->validatorSchema['date_sale'] = new sfValidatorPass();
      
      $this->validatorSchema['addon_costs'] = new sfValidatorPass();
      $this->validatorSchema['addon_expenses'] = new sfValidatorPass();
      
      $this->mergePostValidator(new itrSecuritiesFormValidatorSchema());
      unset($this['submission_id']);
  }
}
