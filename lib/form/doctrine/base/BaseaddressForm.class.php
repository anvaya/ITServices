<?php

/**
 * address form base class.
 *
 * @method address getObject() Returns the current form's model object
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseaddressForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'address_type' => new sfWidgetFormInputText(),
      'member_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('member'), 'add_empty' => true)),
      'flat_no'      => new sfWidgetFormInputText(),
      'premises'     => new sfWidgetFormInputText(),
      'street'       => new sfWidgetFormInputText(),
      'area'         => new sfWidgetFormInputText(),
      'city'         => new sfWidgetFormInputText(),
      'state'        => new sfWidgetFormInputText(),
      'country'      => new sfWidgetFormInputText(),
      'pin'          => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'address_type' => new sfValidatorInteger(),
      'member_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('member'), 'required' => false)),
      'flat_no'      => new sfValidatorPass(array('required' => false)),
      'premises'     => new sfValidatorPass(array('required' => false)),
      'street'       => new sfValidatorPass(array('required' => false)),
      'area'         => new sfValidatorPass(array('required' => false)),
      'city'         => new sfValidatorPass(array('required' => false)),
      'state'        => new sfValidatorPass(array('required' => false)),
      'country'      => new sfValidatorPass(array('required' => false)),
      'pin'          => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('address[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'address';
  }

}
