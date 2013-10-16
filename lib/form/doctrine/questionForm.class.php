<?php

/**
 * question form.
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class questionForm extends BasequestionForm
{
  public function configure()
  {
      $this->widgetSchema['answer_type']     = widgetHelper::getWidget(widgetHelper::WIDGET_ANSWER_TYPE);
      $this->validatorSchema['answer_type']  = widgetHelper::getValidator(widgetHelper::WIDGET_ANSWER_TYPE, array("required"=>true));
  }
}
