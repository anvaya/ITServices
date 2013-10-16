<?php

/**
 * family_contact form.
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class family_contactForm extends Basefamily_contactForm
{
  /**
   * @see contactForm
   */
  public function configure()
  {
    parent::configure();
    unset($this['member_id']);
    
    $relations = array(""=>"Select","1"=>"Son","2"=>"Daughter","3"=>"Wife","4"=>"Sister","5"=>"Mother","6"=>"Father","7"=>"Brother");
    $this->widgetSchema['relation'] = new sfWidgetFormChoice(array("choices"=>$relations));
    $this->validatorSchema['relation'] = new sfValidatorChoice(array("choices"=>array_keys($relations),"required"=>false));
    $this->useFields( array("first_name","last_name","relation","dob"));
    
    $years = array();
    for ($i = date('Y') - 80; $i <= date('Y') ; $i++)
        $years[$i] = $i;
        
    $this->widgetSchema['dob']->setOption('years', $years);
    $this->widgetSchema['dob']->setLabel('Date of Birth');
    $this->widgetSchema['dob']->setOption('format', "%day%-%month%-%year%");
    $this->validatorSchema['dob'] = new sfValidatorDate();

    $this->validatorSchema['dob']->setOption('required',false);
    $this->validatorSchema['first_name']->setOption('required',false);
    $this->validatorSchema['last_name']->setOption('required',false);
    $this->validatorSchema['relation']->setOption('required',false);
    
    $this->useFields(array("relation","first_name","last_name","dob"));
    
  }
}
