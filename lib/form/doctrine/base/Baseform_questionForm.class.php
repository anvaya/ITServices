<?php

/**
 * form_question form base class.
 *
 * @method form_question getObject() Returns the current form's model object
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class Baseform_questionForm extends questionForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema   ['form_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('submission_form'), 'add_empty' => true));
    $this->validatorSchema['form_id'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('submission_form'), 'required' => false));

    $this->widgetSchema   ['mandatory'] = new sfWidgetFormInputCheckbox();
    $this->validatorSchema['mandatory'] = new sfValidatorBoolean(array('required' => false));

    $this->widgetSchema   ['group_code'] = new sfWidgetFormInputText();
    $this->validatorSchema['group_code'] = new sfValidatorPass(array('required' => false));

    $this->widgetSchema   ['display_order'] = new sfWidgetFormInputText();
    $this->validatorSchema['display_order'] = new sfValidatorInteger(array('required' => false));

    $this->widgetSchema   ['css_class'] = new sfWidgetFormInputText();
    $this->validatorSchema['css_class'] = new sfValidatorPass(array('required' => false));

    $this->widgetSchema   ['page_num'] = new sfWidgetFormInputText();
    $this->validatorSchema['page_num'] = new sfValidatorInteger(array('required' => false));

    $this->widgetSchema   ['date_min_year'] = new sfWidgetFormInputText();
    $this->validatorSchema['date_min_year'] = new sfValidatorInteger(array('required' => false));

    $this->widgetSchema   ['date_max_year'] = new sfWidgetFormInputText();
    $this->validatorSchema['date_max_year'] = new sfValidatorInteger(array('required' => false));

    $this->widgetSchema   ['error_msg'] = new sfWidgetFormInputText();
    $this->validatorSchema['error_msg'] = new sfValidatorPass(array('required' => false));

    $this->widgetSchema->setNameFormat('form_question[%s]');
  }

  public function getModelName()
  {
    return 'form_question';
  }

}
