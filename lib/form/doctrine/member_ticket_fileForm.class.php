<?php

/**
 * ticket_comment form.
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class member_ticket_fileForm extends Baseticket_fileForm
{
  public function configure()
  {
    unset($this['comment_id'],$this['file_name']);
    $this->widgetSchema['original_name'] = new sfWidgetFormInputFile();
    $this->validatorSchema['original_name'] = new sfValidatorFile(array(
              'path' => sfConfig::get('sf_upload_dir') . "/assets/",
              'required' => false,
              'mime_types' => 'web_images'
        ));
    
    

  }
}
