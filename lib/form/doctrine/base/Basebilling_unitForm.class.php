<?php

/**
 * billing_unit form base class.
 *
 * @method billing_unit getObject() Returns the current form's model object
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class Basebilling_unitForm extends type_infoForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('billing_unit[%s]');
  }

  public function getModelName()
  {
    return 'billing_unit';
  }

}
