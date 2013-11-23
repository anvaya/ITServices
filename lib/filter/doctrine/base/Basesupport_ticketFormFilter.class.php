<?php

/**
 * support_ticket filter form base class.
 *
 * @package    BestBuddies
 * @subpackage filter
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class Basesupport_ticketFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'tracking_no'    => new sfWidgetFormFilterInput(),
      'member_id'      => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('member'), 'add_empty' => true)),
      'department_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('department'), 'add_empty' => true)),
      'product_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('product'), 'add_empty' => true)),
      'sender_email'   => new sfWidgetFormFilterInput(),
      'ticket_subject' => new sfWidgetFormFilterInput(),
      'created_by'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('CreateByUser'), 'add_empty' => true)),
      'date_received'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'status'         => new sfWidgetFormFilterInput(),
      'assigned_to'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('AssignedToUser'), 'add_empty' => true)),
      'billable'       => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'billed_units'   => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'tracking_no'    => new sfValidatorPass(array('required' => false)),
      'member_id'      => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('member'), 'column' => 'id')),
      'department_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('department'), 'column' => 'id')),
      'product_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('product'), 'column' => 'id')),
      'sender_email'   => new sfValidatorPass(array('required' => false)),
      'ticket_subject' => new sfValidatorPass(array('required' => false)),
      'created_by'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('CreateByUser'), 'column' => 'id')),
      'date_received'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'status'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'assigned_to'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('AssignedToUser'), 'column' => 'id')),
      'billable'       => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'billed_units'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('support_ticket_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'support_ticket';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'tracking_no'    => 'Text',
      'member_id'      => 'ForeignKey',
      'department_id'  => 'ForeignKey',
      'product_id'     => 'ForeignKey',
      'sender_email'   => 'Text',
      'ticket_subject' => 'Text',
      'created_by'     => 'ForeignKey',
      'date_received'  => 'Date',
      'status'         => 'Number',
      'assigned_to'    => 'ForeignKey',
      'billable'       => 'Boolean',
      'billed_units'   => 'Number',
    );
  }
}
