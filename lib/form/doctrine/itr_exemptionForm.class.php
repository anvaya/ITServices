<?php

/**
 * itr_exemption form.
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class itr_exemptionForm extends Baseitr_exemptionForm
{
  public function configure()
  {
     $this->validatorSchema['remove'] = new sfValidatorPass();
     unset($this['submission_id']);
  }
}
