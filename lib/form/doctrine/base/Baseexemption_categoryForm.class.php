<?php

/**
 * exemption_category form base class.
 *
 * @method exemption_category getObject() Returns the current form's model object
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class Baseexemption_categoryForm extends type_infoForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('exemption_category[%s]');
  }

  public function getModelName()
  {
    return 'exemption_category';
  }

}
