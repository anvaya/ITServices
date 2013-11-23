<?php

/**
 * support_ticket form base class.
 *
 * @method support_ticket getObject() Returns the current form's model object
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class Basesupport_ticketForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'tracking_no'    => new sfWidgetFormInputText(),
      'member_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('member'), 'add_empty' => true)),
      'department_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('department'), 'add_empty' => true)),
      'product_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('product'), 'add_empty' => true)),
      'sender_email'   => new sfWidgetFormInputText(),
      'ticket_subject' => new sfWidgetFormInputText(),
      'created_by'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreateByUser'), 'add_empty' => true)),
      'date_received'  => new sfWidgetFormDate(),
      'status'         => new sfWidgetFormInputText(),
      'assigned_to'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AssignedToUser'), 'add_empty' => true)),
      'billable'       => new sfWidgetFormInputCheckbox(),
      'billed_units'   => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'tracking_no'    => new sfValidatorPass(array('required' => false)),
      'member_id'      => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('member'), 'required' => false)),
      'department_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('department'), 'required' => false)),
      'product_id'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('product'), 'required' => false)),
      'sender_email'   => new sfValidatorPass(array('required' => false)),
      'ticket_subject' => new sfValidatorPass(array('required' => false)),
      'created_by'     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('CreateByUser'), 'required' => false)),
      'date_received'  => new sfValidatorDate(array('required' => false)),
      'status'         => new sfValidatorInteger(array('required' => false)),
      'assigned_to'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('AssignedToUser'), 'required' => false)),
      'billable'       => new sfValidatorBoolean(array('required' => false)),
      'billed_units'   => new sfValidatorInteger(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'support_ticket', 'column' => array('tracking_no')))
    );

    $this->widgetSchema->setNameFormat('support_ticket[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'support_ticket';
  }

}
