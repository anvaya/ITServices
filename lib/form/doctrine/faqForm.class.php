<?php

/**
 * faq form.
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class faqForm extends BasefaqForm
{
  public function configure()
  {
       unset($this['slug']);
      $this->widgetSchema['answer'] = new sfWidgetFormTextarea(array(),array('rows'=>10, 'cols'=>80));
  }
}
