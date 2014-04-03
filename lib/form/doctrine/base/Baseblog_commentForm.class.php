<?php

/**
 * blog_comment form base class.
 *
 * @method blog_comment getObject() Returns the current form's model object
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class Baseblog_commentForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'blog_id'           => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('blog'), 'add_empty' => false)),
      'author_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('member'), 'add_empty' => false)),
      'comment_text'      => new sfWidgetFormInputText(),
      'approved'          => new sfWidgetFormInputText(),
      'parent_comment_id' => new sfWidgetFormInputText(),
      'is_read'           => new sfWidgetFormInputCheckbox(),
      'created_at'        => new sfWidgetFormDateTime(),
      'updated_at'        => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'blog_id'           => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('blog'))),
      'author_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('member'))),
      'comment_text'      => new sfValidatorPass(array('required' => false)),
      'approved'          => new sfValidatorInteger(array('required' => false)),
      'parent_comment_id' => new sfValidatorInteger(array('required' => false)),
      'is_read'           => new sfValidatorBoolean(),
      'created_at'        => new sfValidatorDateTime(),
      'updated_at'        => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('blog_comment[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'blog_comment';
  }

}
