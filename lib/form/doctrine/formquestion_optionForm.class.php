<?php

/**
 * formquestion_option form.
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class formquestion_optionForm extends Baseformquestion_optionForm
{
  public function configure()
  {
      unset($this['question_id']);
  }
}
