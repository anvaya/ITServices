<?php

/**
 * blog form base class.
 *
 * @method blog getObject() Returns the current form's model object
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseblogForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'title'            => new sfWidgetFormInputText(),
      'author_id'        => new sfWidgetFormInputText(),
      'summary'          => new sfWidgetFormInputText(),
      'blog'             => new sfWidgetFormInputText(),
      'image'            => new sfWidgetFormInputText(),
      'status'           => new sfWidgetFormInputText(),
      'alert_on_comment' => new sfWidgetFormInputCheckbox(),
      'approved'         => new sfWidgetFormInputCheckbox(),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
      'slug'             => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'title'            => new sfValidatorPass(),
      'author_id'        => new sfValidatorInteger(array('required' => false)),
      'summary'          => new sfValidatorPass(array('required' => false)),
      'blog'             => new sfValidatorPass(array('required' => false)),
      'image'            => new sfValidatorPass(array('required' => false)),
      'status'           => new sfValidatorInteger(array('required' => false)),
      'alert_on_comment' => new sfValidatorBoolean(array('required' => false)),
      'approved'         => new sfValidatorBoolean(array('required' => false)),
      'created_at'       => new sfValidatorDateTime(),
      'updated_at'       => new sfValidatorDateTime(),
      'slug'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'blog', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('blog[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'blog';
  }

}
