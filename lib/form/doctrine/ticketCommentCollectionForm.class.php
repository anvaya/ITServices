<?php

/**
 * support_ticket form.
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ticketCommentCollectionForm extends sfForm
{
  const MASTER_MODEL = "support_ticket";
    
  public function configure()
  {      
        if(!$master = $this->getOption(self::MASTER_MODEL))
        {
            throw new InvalidArgumentException('You must provide a '.self::MASTER_MODEL.' object');
        }               
                
        /* @var $master slideshow */
        $details = $master->getTicketComment();
        
        foreach($details as $key=>$value)
        {            
            $form = new member_ticket_commentForm($value);
            $this->embedForm($key, $form);
        }

        for($i=$details->count(); $i<1; $i++)
        {
            $key=$i;
            $value = new ticket_comment();
            $value->setSupportTicket($master);
            $form = new member_ticket_commentForm($value);
            $this->embedForm($key, $form);
            
        }
        
        foreach($details as $key=>$value)
        {            
          $ticketfileForm = new ticketFileCollectionForm(null, array("ticket_comment"=> $value));
          $this->embedForm("ticket_files", $ticketfileForm);
          
        }
        /*$this->widgetSchema['file'] = new sfWidgetFormInputFile();
        $this->validatorSchema['file'] = new sfValidatorFile(array(
                  'path' => sfConfig::get('sf_upload_dir') . "/assets/",
                  'required' => false,
                  'mime_types' => 'web_images'
            ));
        $this->setOption('allow_extra_fields', false);
        */
        
        parent::configure();        
  }
  
  /*protected function doSave($con = null)
  {
    if (file_exists($this->getObject()->getFile()))
    {
      unlink($this->getObject()->getFile());
    }
 
    $file = $this->getValue('file');
    echo $file->getOriginalName();
    exit;
    //$filename = sha1($file->getOriginalName()).$file->getExtension($file->getOriginalExtension());
     echo $filename = $file->getOriginalName().$file->getExtension($file->getOriginalExtension());
     exit();
    $file->save(sfConfig::get('sf_upload_dir').'/'.$filename);
 
    return parent::doSave($con);
  }*/  
}
