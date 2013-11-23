<?php

require_once(sfConfig::get('sf_lib_dir')."/vendor/anvaya/utils.php");

/**
 * Description of notificationTask
 *
 * @author Mrugendra Bhure
 */
class notificationTask extends sfBaseTask
{
    protected function configure() 
    {            
        $this->namespace        = "sdb";
        $this->name             = "sendAlerts";
        
        $this->briefDescription = "Sends notification email for expiring contracts and service.";
        
        $this->addOptions(array(
          new sfCommandOption('application', null, sfCommandOption::PARAMETER_OPTIONAL, 'The application name', 'frontend'),
          new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'prod'),
          new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
          new sfCommandOption('host', null, sfCommandOption::PARAMETER_REQUIRED, 'The host server name', 'ats.anvayatech.com'),
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
    
    
    $context->getConfiguration()->loadHelpers(array("Partial"));       
    
    $host = $options["host"]; 
    $_SERVER['HTTP_HOST'] = $host;        

    //Task 1: Send Contract Expiry Email Alerts
    $settings_table = settingTable::getInstance();
    /* @var $settings_table settingTable */
    $days_to_check = $settings_table->getSettingValue1(settingTable::CONTRACT_EXPIRY_ALERT_EMAIL_DAYS);
    $contracts     = contractTable::getInstance()->getExpiringContracts($days_to_check, true);
    $sent          = 0;
    
    if($contracts->count() > 0)
    {
        $subject  = $settings_table->getSettingValue1(settingTable::CONTRACT_EXPIRY_ALERT_EMAIL_SUBJECT);
        $cc       = $settings_table->getSettingValue1(settingTable::CONTRACT_EXPIRY_ALERT_EMAIL_CC);
        
        foreach($contracts as $contract)
        {
            /* @var $contract contract */
            ob_start();
            include_partial("contract/renewal_alert", array("contract"=>$contract) );
            $message = ob_get_clean();            
            
            $to_name  = $contract->getCompany()->getCompanyName();
            $to_email = $contract->getCompany()->getEmailAddress();            
            
            $result = send_email($to_name, $to_email, $subject, $message, false, false, $cc );           
            
            if($result)
            {
                $contract->setAlertSentOn( date('Y-m-d') );
                $contract->save();
                $sent++;
            }
        }
        
        $this->log("$sent contract expiry alerts sent.");
    }
    else
        $this->log ("No Contracts Expire in the next $days_to_check days.");
    
    //Task 2: Send Asset Service Alerts
    $days_to_check = $settings_table->getSettingValue1(settingTable::SERVICE_DUE_EMAIL_DAYS);
    
    $contract_assetTable = contract_assetTable::getInstance();
    /* @var $contract_assetTable contract_assetTable */
    $cassets = $contract_assetTable->getPendingServiceItems($days_to_check, true);
    
    $customers = array();
    $sent = 0;
    
    if($cassets->count()>0)
    {
        foreach( $cassets as $casset )
        {
            /* @var $casset contract_asset */
            $customer_id = $casset->getContract()->getCompanyId();
            if( !isset($customers[$customer_id]) )
                $customers[$customer_id] = array();
            
            $customers[$customer_id][] = $casset;
        }
        
        $subject = $settings_table->getSettingValue1(SettingTable::SERVICE_DUE_ALERT_EMAIL_SUBJECT);
        $cc      = $settings_table->getSettingValue1(settingTable::SERVICE_DUE_ALERT_EMAIL_CC);
        
        foreach($customers as $id=>$cassets)
        {
            ob_start();
            include_partial('contract/service_due_email', array("customer_id"=>$id, "cassets"=>$cassets )  );
            $message = ob_get_clean();
            
            $company  = Doctrine::getTable('company')->find($id);
            $to_name  = $company->getCompanyName();
            $to_email = $company->getEmailAddress();  
            
            $result = send_email($to_name, $to_email, $subject, $message, false, false, $cc);
            
            if($result)
            {
                foreach($cassets as $casset)
                {
                    /* @var $casset contract_asset */
                    $casset->setAlertSentOn(date('Y-m-d'));
                    $casset->save();
                }                    
                $sent++;
            }
        }
        
        $this->log("$sent service due alerts sent");
    }
    else
        $this->log("No Assets are due service in the next $days_to_check days.");
    
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
    
}

?>