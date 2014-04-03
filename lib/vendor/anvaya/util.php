<?php
function js2PhpTime($jsdate){
  if(preg_match('@(\d+)/(\d+)/(\d+)\s+(\d+):(\d+)@', $jsdate, $matches)==1){
    $ret = mktime($matches[4], $matches[5], 0, $matches[1], $matches[2], $matches[3]);
    //echo $matches[4] ."-". $matches[5] ."-". 0  ."-". $matches[1] ."-". $matches[2] ."-". $matches[3];
  }else if(preg_match('@(\d+)/(\d+)/(\d+)@', $jsdate, $matches)==1){
    $ret = mktime(0, 0, 0, $matches[1], $matches[2], $matches[3]);
    //echo 0 ."-". 0 ."-". 0 ."-". $matches[1] ."-". $matches[2] ."-". $matches[3];
  }
  return $ret;
}

function php2JsTime($phpDate){
    //echo $phpDate;
    //return "/Date(" . $phpDate*1000 . ")/";
    return date("m/d/Y H:i", $phpDate);
}

function php2MySqlTime($phpDate){
    return date("Y-m-d H:i:s", $phpDate);
}

function mySql2PhpTime($sqlDate){
    $arr = date_parse($sqlDate);
    return mktime($arr["hour"],$arr["minute"],$arr["second"],$arr["month"],$arr["day"],$arr["year"]);

}

function RIJNDAEL_encrypt($text, $key)
   {

        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);        
        return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $text, MCRYPT_MODE_ECB, $iv));

   }

   function RIJNDAEL_decrypt($text, $key)
   {
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);        
        //I used trim to remove trailing spaces
        return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, base64_decode($text), MCRYPT_MODE_ECB, $iv));

   }
   
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

            $msg = $mailer->compose();
            $msg->addTo($to_email, $to_name);

            if(!$from_email)
            {
                $from_email = sfConfig::get('app_company_auto_email');
            }

            if(!$from_name)
            {
                $from_name  = "Groworth Real Solutions";
            }

            if(!$cc)
            {
                $cc    = sfConfig::get('app_company_auto_email_cc', false);
            }

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
}
?>
