<?php

/**
 * family_contact form base class.
 *
 * @method family_contact getObject() Returns the current form's model object
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class Basefamily_contactForm extends contactForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('family_contact[%s]');
  }

  public function getModelName()
  {
    return 'family_contact';
  }

}
