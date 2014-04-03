<?php

/**
 * support_ticket form.
 *
 * @package    BestBuddies
 * @subpackage form
 * @author     Anvaya Technologies
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ticketFileCollectionForm extends sfForm
{
  const MASTER_MODEL = "ticket_comment";
    
  public function configure()
  {      
        if(!$master = $this->getOption(self::MASTER_MODEL))
        {
            throw new InvalidArgumentException('You must provide a '.self::MASTER_MODEL.' object');
        }

        $this->widgetSchema['file_name'] = new sfWidgetFormInputFile();
        $this->validatorSchema['file_name'] = new sfValidatorFile(array(
                  'path' => sfConfig::get('sf_upload_dir') . "/assets/",
                  'required' => false,
                  'mime_types' => 'web_images'
            ));
      
        /* @var $master slideshow */
        $details = $master->getTicketFile();
        
        foreach($details as $key=>$value)
        {            
            $form = new member_ticket_fileForm($value);
            $this->embedForm($key, $form);
        }

        for($i=$details->count(); $i<1; $i++)
        {
            $key=$i;
            $value = new ticket_file();
            $value->setTicketComment($master);
            $form = new member_ticket_fileForm($value);
            $this->embedForm($key, $form);
        }

        parent::configure();        
  }
}
