<?php

/**
 * Description of reminderSendTask
 *
 * @author keval
 */
require_once sfConfig::get('sf_lib_dir')."/vendor/anvaya/util.php";

class reminderSendTask extends sfDoctrineBaseTask {
  
  protected function configure()
  {
    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_OPTIONAL, 'The application name', 'backend'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
      new sfCommandOption('host', null, sfCommandOption::PARAMETER_REQUIRED, 'The host server name', 'localhost'),
    ));
        
    
    $this->namespace = "reminder";
    $this->name = "send";
    $this->briefDescription = 'Email send from reminder table';
    $this->detailedDescription = <<<EOF
      The [reminder:send|INFO] task manages the process of achieving things for send alert email.
Call it with:
  [php symfony reminder:send ]
EOF;
  }
  
  protected function execute($arguments = array(), $options = array())
  {
    $databaseManager = new sfDatabaseManager($this->configuration);

    @set_time_limit(0); // try to give ourselves plenty of time to run
    @ini_set('memory_limit', '512M');
    
    $query = Doctrine_Query::create()
      ->from('reminder r')
      ->where('datediff(r.start_date, now()) = 0')
      ->orWhere('datediff(DATE_ADD(r.start_date, INTERVAL first_reminder_days DAY ), now()) = 0')
      ->orWhere('datediff(DATE_ADD(r.start_date, INTERVAL second_reminder_days DAY ), now()) = 0')
      ->orWhere('datediff(DATE_ADD(r.start_date, INTERVAL third_reminder_days DAY ), now()) = 0');
    $query->getSqlQuery();
    $reminders = $query->execute();
    
    $sent = 0;
    $encryption_key = sfConfig::get('sf_survey_encryption_key');

    // create a context, and load the helper
    $context = sfContext::createInstance($this->configuration);
    $this->configuration->loadHelpers('Partial');

    // Additional headers
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    //$headers .= 'To: '. $member->getFirstName()."<". $member->getEmailAddress().">". "\r\n";
    $headers .= 'From: Best Buddies <reminder@bestbuddies.org>' . "\r\n";
    //$headers .= 'Cc: contact@anvayatech.com' . "\r\n";
    $headers .= 'Cc: keval23@gmail.com' . "\r\n";

    /* @var $reminder reminder */
    foreach($reminders as $reminder)
    {
        $member_types = $reminder->getReminderMembertypes();
        
        if($reminder->getSurveyId() > 0)
          $survey_mail = TRUE;
        else
          $survey_mail = FALSE;
        
        foreach($member_types as $member_type)
        {
            /* @var $member_type reminder_membertypes */
            $members = $member_type->getMemberType()->getMember();

            foreach($members as $member)
            {
              
              if($survey_mail)
              {
                $survey = Doctrine_Core::getTable('survey')->find($reminder->getSurveyId());
                $survey_info = array($survey->getId(), $member->getId());
                $serialized  = serialize($survey_info);
                $encrypted   = RIJNDAEL_encrypt($serialized, $encryption_key);
                $link        = urlencode($encrypted);

                $email_body = get_partial("survey/invitation_email_body", array("member" => $member, "survey" => $survey, "link" => $link));
                $subject  = "Survey Reminder: ".$survey->getTitle();
              }
              else
              {
                $email_body = get_partial("reminder/reminder_email_body", array("member"=>$member,"reminder" => $reminder));
                $subject  = "Reminder: ".$reminder->getAlertTitle();
              }
              
              $to = $member->getFirstName()."<". $member->getEmailAddress().">";
              
              // Mail it
              $result = @mail($to, $subject, $email_body, $headers);
              if($result)
              {
                reminder_dataTable::addEmailed($member->getId(), $reminder->getId(),1);
                $sent++;
              }
              else
              {
                if($survey_mail)
                  unset($link);
                $this->logSection("result", "Reminder mail not sent to " .$member->getFirstName()." (". $member->getEmailAddress().")");
              }
              
            }
        }
    }
    $this->logSection("result", 'Reminder mail sent' );

    $databaseManager->shutdown();
  }  
}

?>
