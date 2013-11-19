<?php

/**
 * site_page form base class.
 *
 * @method site_page getObject() Returns the current form's model object
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class Basesite_pageForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'title'            => new sfWidgetFormInputText(),
      'parent_page_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ParentPage'), 'add_empty' => true)),
      'page_content'     => new sfWidgetFormTextarea(),
      'meta_keywords'    => new sfWidgetFormTextarea(),
      'meta_description' => new sfWidgetFormTextarea(),
      'status'           => new sfWidgetFormInputText(),
      'display_order'    => new sfWidgetFormInputText(),
      'template'         => new sfWidgetFormInputText(),
      'members_only'     => new sfWidgetFormInputCheckbox(),
      'admin_only'       => new sfWidgetFormInputCheckbox(),
      'slug'             => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'title'            => new sfValidatorString(array('max_length' => 255)),
      'parent_page_id'   => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('ParentPage'), 'required' => false)),
      'page_content'     => new sfValidatorString(array('max_length' => 50000, 'required' => false)),
      'meta_keywords'    => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'meta_description' => new sfValidatorString(array('max_length' => 2000, 'required' => false)),
      'status'           => new sfValidatorInteger(array('required' => false)),
      'display_order'    => new sfValidatorInteger(array('required' => false)),
      'template'         => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'members_only'     => new sfValidatorBoolean(array('required' => false)),
      'admin_only'       => new sfValidatorBoolean(array('required' => false)),
      'slug'             => new sfValidatorString(array('max_length' => 255, 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'site_page', 'column' => array('slug')))
    );

    $this->widgetSchema->setNameFormat('site_page[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'site_page';
  }

}
