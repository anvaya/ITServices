<?php

require_once(sfConfig::get('sf_lib_dir')."/vendor/anvaya/utils.php");

/**
 * Description of noSubmissionAlertsTask
 *
 * @author Mrugendra Bhure
 */
class noSubmissionAlertsTask extends sfBaseTask
{    
    protected function configure() 
    {            
        $this->namespace        = "ITS";
        $this->name             = "sendSubmissionReminders";
        
        $this->briefDescription = "Sends notification email for pending submissions.";
        
        $this->addOptions(array(
          new sfCommandOption('application', null, sfCommandOption::PARAMETER_OPTIONAL, 'The application name', 'backend'),
          new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'prod'),
          new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
          new sfCommandOption('host', null, sfCommandOption::PARAMETER_REQUIRED, 'The host server name', 'groworth.in'),
        ));
        
        $this->detailedDescription = <<<EOF
Sends notification email for expiring contracts and service.   
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
    
    
    $context->getConfiguration()->loadHelpers(array("Partial","Url","Tag", "Asset"));       
    
       
    $host = $options["host"]; 
    $_SERVER['HTTP_HOST'] = $host;        
    $relative_root = 'http://'.$host."/web";    
    
    //Select all subscriptions started 7 days back or more, where submission has not been made and reminder has not being sent or sent
    //15 days or more back.
    $query = "select m.first_name, m.email_address, m.email_address, m.gender, m.married, q.id, q.itr_product_id from".
             " gts_sf_guard_user m inner join (".            
             " select ms.id, ms.member_id, ms.itr_product_id, ms.start_date, ms.reminder_date from gts_member_subscription ms left join gts_itr_submission it on".
                    " ms.member_id = it.member_id and ms.itr_product_id = it.product_id".
                    " where it.id is null and ms.active = 1 and datediff(now(),ms.start_date)>=7".
                    " and (ms.reminder_date is null Or datediff(now(), ms.reminder_date)>=5)".
            ") q on m.id = q.member_id";    
    
    
    ob_start();
    include sfConfig::get('sf_data_dir')."/templates/email/no_submission_reminder.html";
    $template = ob_get_clean();    
    
    $conn =  Doctrine_Manager::getInstance()
                ->getConnection('doctrine');
    
    $stmt = $conn->execute($query);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    unset($stmt);
    
    $update_query = "update gts_member_subscription set reminder_date = now() where id = ?";
    
    foreach($rows as $row)
    {        
        $member_name = getQualifiedName($row['first_name'], $row['gender'], $row['married']);
        $message = str_ireplace("{member_name}", $member_name, $template);
        $subject = "Income Tax Return Reminder";
        $this->logSection('info', 'Sending to '.$row['email_address']);
        $sent = send_email($member_name, $row['email_address'] , $subject, $message);
        
        if($sent)
        {
            $conn->exec($update_query, array($row['id']) );
        }
        else
        {
            $this->logSection('info', 'Failed');
        }
    }
    
    unset($rows);
    $conn->close();        
  }
}
?>