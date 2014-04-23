<?php

/**
 * member_relation form base class.
 *
 * @method member_relation getObject() Returns the current form's model object
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class Basemember_relationForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'member1'  => new sfWidgetFormInputHidden(),
      'member2'  => new sfWidgetFormInputHidden(),
      'relation' => new sfWidgetFormChoice(array('choices' => array('P' => 'P', 'SP' => 'SP', 'GP' => 'GP', 'SB' => 'SB'))),
    ));

    $this->setValidators(array(
      'member1'  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('member1')), 'empty_value' => $this->getObject()->get('member1'), 'required' => false)),
      'member2'  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('member2')), 'empty_value' => $this->getObject()->get('member2'), 'required' => false)),
      'relation' => new sfValidatorChoice(array('choices' => array(0 => 'P', 1 => 'SP', 2 => 'GP', 3 => 'SB'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('member_relation[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'member_relation';
  }

}
