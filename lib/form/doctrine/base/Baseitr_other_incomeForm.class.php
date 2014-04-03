<?php

/**
 * itr_other_income form base class.
 *
 * @method itr_other_income getObject() Returns the current form's model object
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class Baseitr_other_incomeForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'submission_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('itr_submission'), 'add_empty' => true)),
      'category_id'   => new sfWidgetFormInputText(),
      'details'       => new sfWidgetFormTextarea(),
      'date_rcvd'     => new sfWidgetFormDate(),
      'amount'        => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'submission_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('itr_submission'), 'required' => false)),
      'category_id'   => new sfValidatorInteger(array('required' => false)),
      'details'       => new sfValidatorString(array('max_length' => 300, 'required' => false)),
      'date_rcvd'     => new sfValidatorDate(array('required' => false)),
      'amount'        => new sfValidatorNumber(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('itr_other_income[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'itr_other_income';
  }

}
