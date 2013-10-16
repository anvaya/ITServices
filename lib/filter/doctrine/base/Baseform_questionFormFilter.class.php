<?php

/**
 * form_question filter form base class.
 *
 * @package    BestBuddies
 * @subpackage filter
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedInheritanceTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class Baseform_questionFormFilter extends questionFormFilter
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema   ['form_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('submission_form'), 'add_empty' => true));
    $this->validatorSchema['form_id'] = new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('submission_form'), 'column' => 'id'));

    $this->widgetSchema   ['mandatory'] = new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no')));
    $this->validatorSchema['mandatory'] = new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0)));

    $this->widgetSchema   ['group_code'] = new sfWidgetFormFilterInput();
    $this->validatorSchema['group_code'] = new sfValidatorPass(array('required' => false));

    $this->widgetSchema   ['display_order'] = new sfWidgetFormFilterInput();
    $this->validatorSchema['display_order'] = new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false)));

    $this->widgetSchema   ['css_class'] = new sfWidgetFormFilterInput();
    $this->validatorSchema['css_class'] = new sfValidatorPass(array('required' => false));

    $this->widgetSchema   ['page_num'] = new sfWidgetFormFilterInput();
    $this->validatorSchema['page_num'] = new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false)));

    $this->widgetSchema   ['date_min_year'] = new sfWidgetFormFilterInput();
    $this->validatorSchema['date_min_year'] = new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false)));

    $this->widgetSchema   ['date_max_year'] = new sfWidgetFormFilterInput();
    $this->validatorSchema['date_max_year'] = new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false)));

    $this->widgetSchema   ['error_msg'] = new sfWidgetFormFilterInput();
    $this->validatorSchema['error_msg'] = new sfValidatorPass(array('required' => false));

    $this->widgetSchema->setNameFormat('form_question_filters[%s]');
  }

  public function getModelName()
  {
    return 'form_question';
  }

  public function getFields()
  {
    return array_merge(parent::getFields(), array(
      'form_id' => 'ForeignKey',
      'mandatory' => 'Boolean',
      'group_code' => 'Text',
      'display_order' => 'Number',
      'css_class' => 'Text',
      'page_num' => 'Number',
      'date_min_year' => 'Number',
      'date_max_year' => 'Number',
      'error_msg' => 'Text',
    ));
  }
}
