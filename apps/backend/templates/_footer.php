<div id="footer">       
        <div align="center" style="border-top: 1px solid #CCC; padding-top: 5px;"><?php echo image_tag("logo.png");?></div>
        <?php #echo image_tag("Heritage_logo.png", array("id"=>"logo") ); ?>
        <div align="center" style="margin-top: -30px"> 
                        <p>                            
                            <b>CMS v 1.0</b>
                            <br /><br /> 
                            <?php if($sf_user->isAuthenticated() && $sf_user->hasAttribute("prev_login")): ?>
                                Previous Successful Login: <?php echo $sf_user->getAttribute("prev_login") ."  IP: " . long2ip($sf_user->getAttribute("prev_login_ip"))?>
                            <?php endif?>
                            
                            <br /><br />
                            Copyright &copy;&nbsp;<?php echo date('Y');?>
                        </p>                
        </div>
        <?php #echo image_tag("pentagons.png", array("id"=>"pentagons") );?>
    </div>