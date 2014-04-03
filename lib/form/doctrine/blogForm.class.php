<?php

/**
 * blog form.
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class blogForm extends BaseblogForm
{
  public function configure()
  {
      $user = sfContext::getInstance()->getUser()->getGuardUser();
      
      /* @var $user sfGuardUser */
      $this->widgetSchema['author_id'] = new sfWidgetFormInputHidden();
      $this->widgetSchema['author_id']->setDefault($user->getId());
      
    $this->widgetSchema["image"] = new sfWidgetFormInputFileEditable(array(
                'file_src'    => public_path('/uploads/images/blog/'.$this->getObject()->getImage()),
                'edit_mode'   => !$this->isNew(),
                'is_image'    => true,
                'with_delete' => true,
               ));

      $this->validatorSchema["image"]  = new sfValidatorFile(array("required"=>false,"path"=> sfConfig::get("sf_upload_dir")."/images/blog/", "mime_types"=>"web_images"));
      $this->validatorSchema["image_delete"]  = new sfValidatorPass(array("required"=>false));
 
      $this->widgetSchema['blog'] = new sfWidgetFormTextareaTinyMCE(array(
  'width'  => 550,
  'height' => 350,
  'config' => 'theme_advanced_disable: "anchor,image,cleanup,help"',));
       
    /*  $this->widgetSchema['tags'] = new sfWidgetFormTextarea();
      $this->validatorSchema['tags'] = new sfValidatorString(array("required"=>false));*/
      
      
      $choices = blogTable::$status_choices;
      $this->widgetSchema['status'] = new sfWidgetFormChoice(array("choices"=>$choices));
      $this->validatorSchema['status'] = new sfValidatorChoice(array("choices"=> array_keys($choices) ));
      
      $this->mergePostValidator(new blogValidatorSchema());

      $this->widgetSchema['summary'] = new sfWidgetFormTextarea();
      
      unset($this['created_at'],$this['updated_at']);
  }
}
