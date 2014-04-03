<?php

/**
 * itr_other_income form.
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class itr_other_incomeForm extends Baseitr_other_incomeForm
{
  public function configure()
  {     
      $this->validatorSchema['date_rcvd'] = new sfValidatorPass();
      $this->validatorSchema['remove'] = new sfValidatorPass();
      
      $this->mergePostValidator(new itrOtherIncomeFormValidatorSchema());
      unset($this['submission_id']);
  }
}
