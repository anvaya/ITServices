<?php

/**
 * ticket_file form base class.
 *
 * @method ticket_file getObject() Returns the current form's model object
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class Baseticket_fileForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'comment_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ticket_comment'), 'add_empty' => false)),
      'file_name'     => new sfWidgetFormInputText(),
      'original_name' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'comment_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ticket_comment'))),
      'file_name'     => new sfValidatorPass(array('required' => false)),
      'original_name' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('ticket_file[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ticket_file';
  }

}
