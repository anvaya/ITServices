<?php
function send_email($to_name, $to_email, $subject, $message, $from_name=false, $from_email=false, $cc=false, $html=true)
{
    try
    {
        #$to_email = "mike.howie@advanced-thinking.co.uk";
        #$to_email = "mrugendrabhure@gmail.com";
        $mailer = sfContext::getInstance()->getMailer();
        /* @var $mailer sfMailer */
        
        $msg = $mailer->compose();
        $msg->addTo($to_email, $to_name);

        if(!$from_email)
            $from_email = sfConfig::get('app_company_auto_email');
        
        if(!$from_name)
            $from_name  = "Groworth Real Solutions";
        
        if(!$cc)
            $cc    = sfConfig::get('app_company_auto_email_cc');
        
        $msg->addCc($cc);
        $msg->addFrom($from_email, $from_name);
        $msg->setSubject($subject);
        $msg->setBody($message, "text/html");

        $mailer->sendNextImmediately();
        return $mailer->send($msg);
        
        /*
        $headers = "";
        
        if($html)
        {
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        }        
        
        if(!$from_email)
            $from_email = sfConfig::get('app_company_auto_email');
        
        if(!$from_name)
            $from_name  = "ATS Heritage";
        
        if(!$cc)
            $cc    = sfConfig::get('app_auto_email_cc');

        // Additional headers
        $headers .= 'To: '. $to_name . '<' . $to_email . '>'. "\r\n";
        $headers .= 'From: ' . $from_name .'<'. $from_email . '>' . "\r\n";
        
        if(strlen($cc)>0)
            $headers .= 'Cc: ' . $cc . "\r\n";        
        
        // Mail it       
        return mail($to_email, $subject, $message, $headers);
         * 
         */
    }catch(Exception $ex)
    {
        return false;
    }    
}
