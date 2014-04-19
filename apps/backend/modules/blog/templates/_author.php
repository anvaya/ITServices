<?php if ($blog->getAuthorId()): ?>
  <?php 
      $user = Doctrine_Core::getTable('sfGuardUser')->find($blog->getAuthorId());  
      if($user)
        echo $user->getUsername(). "(".$user->getFirstName()." ".$user->getLastName(). ")";
  ?>
<?php endif; ?>
&nbsp;
