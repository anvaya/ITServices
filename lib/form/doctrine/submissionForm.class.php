<?php

/**
 * submission form.
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class submissionForm extends BasesubmissionForm
{
  public function configure()
  {
      $this->widgetSchema['status'] = new sfWidgetFormChoice( array("choices" => pan_applicationTable::$STATUS_TYPES ) );
      $this->validatorSchema['status'] = new sfValidatorChoice( array("choices" => array_keys(pan_applicationTable::$STATUS_TYPES), "required"=>false ) );
  }
}
