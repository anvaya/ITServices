<?php

require_once(sfConfig::get('sf_lib_dir')."/vendor/anvaya/utils.php");
require_once(dirname(dirname(__FILE__))."/vendor/anvaya/lib/Imap.class.php");

/**
 * Description of notificationTask
 *
 * @author Mrugendra Bhure
 */
class ticketImportTask extends sfBaseTask
{
    protected function configure() 
    {            
        $this->namespace        = "sdb";
        $this->name             = "importTickets";
        
        $this->briefDescription = "Import Ticket Emails";
        
        $this->addOptions(array(
          new sfCommandOption('application', null, sfCommandOption::PARAMETER_OPTIONAL, 'The application name', 'backend'),
          new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'prod'),
          new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
          new sfCommandOption('host', null, sfCommandOption::PARAMETER_REQUIRED, 'The host server name', 'groworth.in'),
        ));
        
        $this->detailedDescription = <<<EOF
Imports Ticket Emails.   
EOF;
    }
    
  protected function execute($arguments = array(), $options = array())
  {
    #$databaseManager = new sfDatabaseManager($this->configuration);

    if(sfContext::hasInstance())
    {        
        $context = sfContext::getInstance();
    }
    else
    {            
        $configuration = $this->configuration;
        $context = sfContext::createInstance($configuration);            
    }    
    
    $host = $options["host"]; 
    $_SERVER['HTTP_HOST'] = $host;        
    
    $context->getConfiguration()->loadHelpers(array("Partial"));    
    
    $mail_config = sfConfig::get('app_import_ticket');
       
    $mail_server    = $mail_config['host'];
    $mail_port      = $mail_config['port'];
    $mail_username  = $mail_config['username'];
    $mail_pwd       = $mail_config['pwd'];
    $mail_tls       = $mail_config['tls'];
    $mail_folder    = $mail_config['folder'];
    $mail_ssl       = $mail_config['ssl'];
    $fail_email     = $mail_config['fail_email'];
    
    $result = $this->process_mailbox($mail_server, $mail_username, $mail_pwd, $mail_folder, $mail_port, $mail_tls, $mail_ssl,$fail_email);
    
    $this->log("Processed $result tickets");
  }
  
  /**
     * Processes IMAP mailbox for Ticket Emails
     * @param type $imap_host  Imap Server Address
     * @param type $imap_username Imap Username
     * @param type $imap_password Imap Password
     * @param type $imap_folder  Folder to process.
     * @param type $imap_port Port of the IMAP server.
     * @param type $tls TLS configuration.
     * @return int Returns the number of messages processed, false on failure.
     */
    function process_mailbox($imap_host, $imap_username, $imap_password, $imap_folder, $imap_port, $tls,$ssl,$fail_email=false)
    {               
        //$settings_table = settingTable::getInstance();     
        /* @var $settings_table settingTable */
        
        $processed = 0;
        $this->addLog("Opening Mailbox");
        $reply_delimiter = "========= PLEASE DO NOT REMOVE THIS LINE =======";
        $imap = new Imap($imap_host, $imap_username, $imap_password, $imap_folder, $imap_port, $tls,$ssl);
        $fp = false;
        
        if($imap->get_is_connected())
        {
            $this->addLog("---- Opening Mailbox: Success");
            $status = $imap->returnUnseenMsgIds();
            if($status)
            {              
               $this->addLog("Found $status emails.");               
               
               foreach($status as $i) 
               {
                   try
                   {
                       $this->addLog("Reading email $i");
                       
                       $headers = $imap->returnEmailHeaderArr($i);
                       
                       $this->addLog("--- Got Headers $i");
                       
                       $subject = $headers['subject'];
                       
                       if(strlen($subject) > 0) 
                       {
                         $this->addLog("Reading subject $i $subject");  
                         
                         $pattern =  "/\[ticket \#([^\]]*)/";
                         $match   = false;
                         $iResult = preg_match($pattern, $subject, $match);

                         if($iResult) //Existing Ticket
                         {
                            $tracking_no = $match[1];
                            
                            $ticket = Doctrine::getTable('support_ticket')
                                        ->findOneByTrackingNo($tracking_no);
                            
                            /* @var $ticket support_ticket */                              
                         }
                         else //New Request
                         {
                             $from = $headers['from'];
                             
                             $customer = sfGuardUserTable::getInstance()
                                            ->findOneByEmailAddress($from);
                             
                             /*
                             $customer = Doctrine::getTable('company')
                                            ->findOneByEmailAddress($from);
                             */
                             
                             /* @var $customer sfGuardUser */
                             
                             if(!$customer)
                             {
                                 /*$to = $settings_table->getSettingValue1(settingTable::TICKET_IMPORT_CUST_NOT_FOUND_EMAIL);
                                 $auto_from = sfConfig::get('app_company_auto_email');
                                 
                                 $result = $this->sendCustomerNotFoundError($to, $auto_from, $subject, $from);
                                 if($result)
                                 {
                                     @$imap->mark_read($i);
                                 }*/
                                 $this->logSection("warning",  "Customer not found for email address $from");
                                 continue; //Customer not found.
                             }
                             
                             $ticket = new support_ticket();    
                             $ticket->setDateReceived(date('Y-m-d'));
                             $ticket->setMember($customer);
                             $ticket->setTicketSubject($subject);
                         }
                         
                         $email = $imap->returnEmailMessageArr($i);
                         
                         if(isset($email['plain']))
                             $body = $email['plain'];
                         elseif( isset($email['html']) )
                             $body = $email['html'];
                         
                         if(!isset($body)) continue;  //The email does not have a body ? Move to next message.                                                  
                                               
                         
                         //Remove reply from office from the customer's email.
                         $body_parts = explode($reply_delimiter, $body);
                         $body       = $body_parts[0];
                         
                         //Add Reply.
                         $reply = new ticket_comment();
                         //$reply->setRepairTicket($ticket);
                         $reply->setSupportTicket($ticket);
                         $reply->setPublicMessage($body);
                         
                         $ticket->getTicketComment()->add($reply);
                         
                         if(isset($email['attachments']))
                         {
                            $this->addLog("--- attachment(s) found.");
                           
                            foreach($email['attachments'] as $attachment)
                            {
                               $name = $attachment['name'];
                               
                               $this->addLog("--- attachment: $name");                            
                               
                               $pattern ="/\.pdf$|\.png$|\.gif$|\.jpg$|\.jpeg$|\.bmp$|\.doc|\.docx$|\.xls$|\.xlsx$/i";
                               $match = array();

                               $result = preg_match($pattern, $name, $match);
                               
                               if($result) //Valid Attachment Type.
                               {                                  
                                  $save_name = uniqid("T");
                                  $filepath  = sfConfig::get('sf_data_dir')."/ticket_files/".$save_name;
                                  
                                  $this->addLog("saving attachment");
                                  
                                  $result = $imap->saveAttachment($i, $attachment['part'], $filepath);
                                  
                                  if($result)
                                  {                                      
                                      $ticket_file = new ticket_file();
                                      
                                      $ticket_file->setTicketComment($reply);
                                      $ticket_file->setFileName($save_name.$match[0]);
                                      #$ticket_file->setOriginalName($name);
                                      
                                      $reply->getTicketFile()->add($ticket_file);                                      
                                                                            
                                      $this->addLog("--- Attachment Saved $save_name.");
                                  }
                                  else
                                      $this->addLog("--- Save Attachment Faied: $name.");                                  
                               }
                               else
                                   $this->addLog("--- Invalid Attachment $name");
                            }
                            
                         }
                         
                         $ticket->setStatus( support_ticketTable::STATUS_OPEN );
                         $ticket->save();
                         
                         //TODO: Send Ticket alert to assigned user.
                         if($ticket->getAssignedTo()>0)
                         {
                             $alert_user = $ticket->getAssignedToUser();
                             $alert_subject = "[ticket #".$ticket->getTrackingNo()."]-Customer has replied";
                             
                             $message = "Hi ".$alert_user->getFirstName().",\n";
                             $message .= "\n Customer has replied to the ticket.";
                             $message .= "\n Please login to reply.";
                             $message .= "\n\n == Groworth Ticket System.";
                             
                             $result = send_email($alert_user->getFirstName(), $alert_user->getEmailAddress(), $alert_subject, $message);
                             
                             if($result)
                             {
                                 $reply->setAlertSent(true);
                                 $reply->save();
                             }
                         }
                         
                         $this->addLog("--- submission created.");
                                      
                         @$imap->mark_read($i);

                         $this->addLog("--- Marked Read.");

                         @$imap->delete_message($i);

                         $this->addLog("--- Deleted.");

                         $processed++;
                         
                       }
                       else
                           continue; //Ignore emails with blank subject
                       
                   }catch(Exception $ex)
                   {
                       $this->addLog("Exception $i: ".$ex->getMessage());
                   }
               }
            }
        }
        else
            $this->addLog("Could not connect to mailbox");
        
        return $processed;
    }   
    
    /**
     * Displayes error message
     * @param string $msg  Error message to send.
     */
    function senderror($msg)
    {        
        #sfContext::getInstance()->getLogger()->err("emailImportTask:".$msg);
        @$this->logSection("forms_notification", $msg);
    }
    
    function addLog($msg)
    {	
        
        $file = "/home3/anvayat1/public_html/temppublish/ats/log/emailImport.log";
        #@file_put_contents($file, "ticketImport: ".$msg."\n",FILE_APPEND);
        
    }
    
    function sendCustomerNotFoundError($to, $from, $orig_subject, $cust_email)
    {              
        if(strlen($to)>0)
        {
            $subject = 'Ticket Import: Customer not identified';

            $message = "The system could not find customer matching the email address $cust_email.".
                        "\n The subject of the email: $orig_subject";
                        "\n\n == Groworth Ticket System.";

            $headers = 'From: '.$from. "\r\n" .
                'To: '.$to. "\r\n" .
                'Reply-To: '.$cust_email. "\r\n" .
                'X-Mailer: PHP/' . phpversion();

            return @mail($to, $subject, $message, $headers);        
        }
        else
            $this->addLog ('Customer Not Found Error Email: '.$to.' No Receipient');
    }
}

?>