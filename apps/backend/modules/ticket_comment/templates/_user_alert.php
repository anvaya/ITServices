<?php
         /* @var $user sfGuardUser */ 
         /* @var $ticket_comment ticket_comment */
?>
Hi <?php echo $user->getFirstName(); ?>,<br /><br />

A new ticket has been assigned to you. Please log-in to reply.<br /><br />

Customer Query:<br />
==================<br />
<?php echo $ticket_comment->getPublicMessage(); ?>