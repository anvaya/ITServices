<?php

/**
 * member_subscription form base class.
 *
 * @method member_subscription getObject() Returns the current form's model object
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class Basemember_subscriptionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'member_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('member'), 'add_empty' => false)),
      'subscription_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('subscription'), 'add_empty' => false)),
      'price'           => new sfWidgetFormInputText(),
      'start_date'      => new sfWidgetFormDate(),
      'end_date'        => new sfWidgetFormDate(),
      'active'          => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'member_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('member'))),
      'subscription_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('subscription'))),
      'price'           => new sfValidatorNumber(array('required' => false)),
      'start_date'      => new sfValidatorDate(array('required' => false)),
      'end_date'        => new sfValidatorDate(array('required' => false)),
      'active'          => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('member_subscription[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'member_subscription';
  }

}
