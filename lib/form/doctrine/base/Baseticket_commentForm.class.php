<?php

/**
 * ticket_comment form base class.
 *
 * @method ticket_comment getObject() Returns the current form's model object
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class Baseticket_commentForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'ticket_id'        => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('support_ticket'), 'add_empty' => false)),
      'is_reply'         => new sfWidgetFormInputCheckbox(),
      'public_message'   => new sfWidgetFormInputText(),
      'private_message'  => new sfWidgetFormInputText(),
      'sent_to_customer' => new sfWidgetFormInputCheckbox(),
      'replied_by'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'add_empty' => true)),
      'alert_sent'       => new sfWidgetFormInputCheckbox(),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'ticket_id'        => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('support_ticket'))),
      'is_reply'         => new sfValidatorBoolean(array('required' => false)),
      'public_message'   => new sfValidatorPass(array('required' => false)),
      'private_message'  => new sfValidatorPass(array('required' => false)),
      'sent_to_customer' => new sfValidatorBoolean(array('required' => false)),
      'replied_by'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('sfGuardUser'), 'required' => false)),
      'alert_sent'       => new sfValidatorBoolean(array('required' => false)),
      'created_at'       => new sfValidatorDateTime(),
      'updated_at'       => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('ticket_comment[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'ticket_comment';
  }

}
