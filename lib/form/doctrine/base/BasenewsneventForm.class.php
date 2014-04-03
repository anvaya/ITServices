<?php

/**
 * newsnevent form base class.
 *
 * @method newsnevent getObject() Returns the current form's model object
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasenewsneventForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'is_event'     => new sfWidgetFormInputCheckbox(),
      'event_date'   => new sfWidgetFormDate(),
      'picture_file' => new sfWidgetFormInputText(),
      'title'        => new sfWidgetFormInputText(),
      'subtitle'     => new sfWidgetFormInputText(),
      'event_body'   => new sfWidgetFormTextarea(),
      'disabled'     => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'is_event'     => new sfValidatorBoolean(array('required' => false)),
      'event_date'   => new sfValidatorDate(array('required' => false)),
      'picture_file' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'title'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'subtitle'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'event_body'   => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'disabled'     => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('newsnevent[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'newsnevent';
  }

}
