<?php

/**
 * itr_file form.
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class itr_fileForm extends Baseitr_fileForm
{
  public function configure()
  {
      $this->validatorSchema['remove'] = new sfValidatorPass();            
      
      $files_dir =sfConfig::get('sf_data_dir')."/itr_files";
      
      $mime_categories = array(
                                "csv_files"=>array("application/octet-stream","text/plain","application/pdf","application/vnd.ms-excel","application/vnd.openxmlformats-officedocument.spreadsheetml.sheet","application/vnd.openxmlformats-officedocument.wordprocessingml.document","application/msword"),                                
                              );
      
      $this->widgetSchema['filename'] = new sfWidgetFormInputFileEditable
                                        (
                                            array(
                                            'file_src'    => (strlen($this->getObject()->getFilename())>0)?public_path("member.php/itr/getFile?id=".$this->getObject()->getId()):"" ,
                                            'edit_mode'   => !$this->isNew(),
                                            'is_image'    => false,
                                            'with_delete' => true,
                                                )
                                        );
      
      $this->validatorSchema["filename"]         = new sfValidatorFile(array("required"=>false,"path"=> $files_dir, "mime_categories"=>$mime_categories, "mime_types"=>"csv_files"));
      $this->validatorSchema["filename_delete"]  = new sfValidatorPass(array("required"=>false));
      
      $this->validatorSchema['filename']->setOption('mime_type_guessers', array(
    array($this->validatorSchema['filename'], 'guessFromFileinfo'),          
    array($this->validatorSchema['filename'], 'guessFromMimeContentType'),          
    array($this->validatorSchema['filename'], 'guessFromFileBinary'),
    
  ));
      
      unset($this['submission_id']);
  }
}
