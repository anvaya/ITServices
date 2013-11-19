<?php

/**
 * site_page filter form base class.
 *
 * @package    BestBuddies
 * @subpackage filter
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class Basesite_pageFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'title'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'parent_page_id'   => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('ParentPage'), 'add_empty' => true)),
      'page_content'     => new sfWidgetFormFilterInput(),
      'meta_keywords'    => new sfWidgetFormFilterInput(),
      'meta_description' => new sfWidgetFormFilterInput(),
      'status'           => new sfWidgetFormFilterInput(),
      'display_order'    => new sfWidgetFormFilterInput(),
      'template'         => new sfWidgetFormFilterInput(),
      'members_only'     => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'admin_only'       => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'slug'             => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'title'            => new sfValidatorPass(array('required' => false)),
      'parent_page_id'   => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('ParentPage'), 'column' => 'id')),
      'page_content'     => new sfValidatorPass(array('required' => false)),
      'meta_keywords'    => new sfValidatorPass(array('required' => false)),
      'meta_description' => new sfValidatorPass(array('required' => false)),
      'status'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'display_order'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'template'         => new sfValidatorPass(array('required' => false)),
      'members_only'     => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'admin_only'       => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'slug'             => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('site_page_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'site_page';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'title'            => 'Text',
      'parent_page_id'   => 'ForeignKey',
      'page_content'     => 'Text',
      'meta_keywords'    => 'Text',
      'meta_description' => 'Text',
      'status'           => 'Number',
      'display_order'    => 'Number',
      'template'         => 'Text',
      'members_only'     => 'Boolean',
      'admin_only'       => 'Boolean',
      'slug'             => 'Text',
    );
  }
}
