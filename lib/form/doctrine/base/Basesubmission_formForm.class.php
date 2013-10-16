<?php

/**
 * submission_form form base class.
 *
 * @method submission_form getObject() Returns the current form's model object
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class Basesubmission_formForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'form_code'        => new sfWidgetFormInputText(),
      'form_name'        => new sfWidgetFormInputText(),
      'disabled'         => new sfWidgetFormInputCheckbox(),
      'frequency'        => new sfWidgetFormInputText(),
      'send_reminder'    => new sfWidgetFormInputCheckbox(),
      'form_description' => new sfWidgetFormInputText(),
      'template_name'    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'form_code'        => new sfValidatorPass(array('required' => false)),
      'form_name'        => new sfValidatorPass(),
      'disabled'         => new sfValidatorBoolean(array('required' => false)),
      'frequency'        => new sfValidatorInteger(array('required' => false)),
      'send_reminder'    => new sfValidatorBoolean(array('required' => false)),
      'form_description' => new sfValidatorPass(array('required' => false)),
      'template_name'    => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('submission_form[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'submission_form';
  }

}
