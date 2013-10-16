<?php

/**
 * contact form base class.
 *
 * @method contact getObject() Returns the current form's model object
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasecontactForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'contact_type' => new sfWidgetFormInputText(),
      'member_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('member'), 'add_empty' => true)),
      'country'      => new sfWidgetFormInputText(),
      'isd_code'     => new sfWidgetFormInputText(),
      'std_code'     => new sfWidgetFormInputText(),
      'contact_text' => new sfWidgetFormInputText(),
      'first_name'   => new sfWidgetFormInputText(),
      'last_name'    => new sfWidgetFormInputText(),
      'dob'          => new sfWidgetFormDate(),
      'relation'     => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'contact_type' => new sfValidatorInteger(),
      'member_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('member'), 'required' => false)),
      'country'      => new sfValidatorPass(array('required' => false)),
      'isd_code'     => new sfValidatorPass(array('required' => false)),
      'std_code'     => new sfValidatorPass(array('required' => false)),
      'contact_text' => new sfValidatorPass(array('required' => false)),
      'first_name'   => new sfValidatorPass(array('required' => false)),
      'last_name'    => new sfValidatorPass(array('required' => false)),
      'dob'          => new sfValidatorDate(array('required' => false)),
      'relation'     => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('contact[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'contact';
  }

}
