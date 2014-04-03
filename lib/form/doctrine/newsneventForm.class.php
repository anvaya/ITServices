<?php

/**
 * newsnevent form.
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class newsneventForm extends BasenewsneventForm
{
  public function configure()
  {
       $this->widgetSchema["picture_file"] = new sfWidgetFormInputFileEditable(array(
                        'file_src'    => public_path(basename(sfConfig::get("sf_upload_dir"))) .'/events/'.$this->getObject()->getPictureFile(),
                        'edit_mode'   => !$this->isNew(),
                        'is_image'    => true,
                        'with_delete' => true,
                       ));

      $this->validatorSchema["picture_file"]  = new sfValidatorFile(array("required"=>false,"path"=> sfConfig::get("sf_upload_dir")."/events","mime_types"=>"web_images"));
      $this->validatorSchema["picture_file_delete"]  = new sfValidatorPass(array("required"=>false));
   
      $this->validatorSchema['event_body'] = new sfValidatorString(array('max_length' => 15000, 'required' => false));
      $this->widgetSchema['event_date'] = new sfWidgetFormJQueryDate();
  }
}
