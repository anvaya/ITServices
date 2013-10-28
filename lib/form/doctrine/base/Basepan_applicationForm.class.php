<?php

/**
 * pan_application form base class.
 *
 * @method pan_application getObject() Returns the current form's model object
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class Basepan_applicationForm extends submissionForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema->setNameFormat('pan_application[%s]');
  }

  public function getModelName()
  {
    return 'pan_application';
  }

}
