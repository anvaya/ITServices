<?php

/**
 * itr_file form base class.
 *
 * @method itr_file getObject() Returns the current form's model object
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class Baseitr_fileForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'submission_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('itr_submission'), 'add_empty' => true)),
      'category_id'   => new sfWidgetFormInputText(),
      'filename'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'submission_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('itr_submission'), 'required' => false)),
      'category_id'   => new sfValidatorInteger(array('required' => false)),
      'filename'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('itr_file[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'itr_file';
  }

}
