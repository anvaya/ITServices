<?php
    /* @var $ticket_comment ticket_comment  */    
    $date_format = "d/M/y";
    $reply_delimiter = "========= PLEASE DO NOT REMOVE THIS LINE =======<br />";
    echo $reply_delimiter;
?>
Dear Member,<br /><br />

<p>    
    <?php echo str_replace("\n", "<br />", $ticket_comment->getPublicMessage());?>    
</p>

<br />
<br />
Please reply to this message if you have further queries or comments. Please do not alter the email subject line.