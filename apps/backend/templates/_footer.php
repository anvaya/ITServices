<div id="footer">       
  <div align="center" style="margin-top: -30px"> 
    <p>                            
        <br /><br /> 
        <?php if($sf_user->isAuthenticated() && $sf_user->hasAttribute("prev_login")): ?>
            Previous Successful Login: <?php echo $sf_user->getAttribute("prev_login") ."  IP: " . long2ip($sf_user->getAttribute("prev_login_ip"))?>
        <?php endif?>
        <br /><br />
        Copyright &copy;&nbsp;<?php echo date('Y');?>
    </p>                
  </div>
</div>
