<?php
if(!function_exists("send_email"))
{
function send_email($to_name, $to_email, $subject, $message, $from_name=false, $from_email=false, $cc=false, $html=true)
{
    try
    {
        #$to_email = "mike.howie@advanced-thinking.co.uk";
        #$to_email = "mrugendrabhure@gmail.com";
        $mailer = sfContext::getInstance()->getMailer();
        /* @var $mailer sfMailer */
        
        $reply_to = sfConfig::get('app_company_email');
        
        $msg = $mailer->compose();
        $msg->addTo($to_email, $to_name);

        if(!$from_email)
            $from_email = sfConfig::get('app_company_auto_email');
        
        if(!$from_name)
            $from_name  = "Groworth Real Solutions";
        
        if(!$cc)
            $cc  = sfConfig::get('app_company_auto_email_cc');
        
        $msg->addCc($cc);
        $msg->addReplyTo($reply_to);
        $msg->addFrom($from_email, $from_name);
        $msg->setSubject($subject);
        $msg->setBody($message, "text/html");

        $mailer->sendNextImmediately();
        return $mailer->send($msg);        
       
    }catch(Exception $ex)
    {
        return false;
    }    
}
}

function getQualifiedName($name, $gender, $married)
{    
    $title  = "";

    if($gender)
    {
        if($gender == 'M')
        {
            $title = "Mr. ";
        }
        else
        {
            if($married)
            {
                $title = "Mrs. ";
            }
            else
            {
                $title = "Ms. ";
            }
        }            
    }

    return $title.$name;
}
