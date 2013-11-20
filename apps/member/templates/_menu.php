<div class="bg-page">
   <div class="wrapper">
        <div class="head">
            <div class="logo">
                <?php echo image_tag("logo3.jpg", array("border"=>0));?>                    					
            </div>
            <ul>
                <li><a href="<?php echo public_path("index.html");?>">Home</a></li>
                <li><a href="<?php echo public_path("aboutus.html");?>">About Us</a></li>
                <li><a href="<?php echo public_path("services.html");?>">Services</a></li>
                <!--<li><a href="#">Blog</a></li>-->						
                <li><a href="<?php echo public_path("contactus.html");?>">Contact Us</a></li>						
                <?php if($sf_user->isAuthenticated()):?>
                    <li><a href="<?php echo url_for("@member") ?>">Profile</a></li>						
                <?php endif;?>
            </ul>
            <div class="search">
            </div>            
            <?php if($sf_user->isAuthenticated()):?>
            <div class="login">
                <?php echo link_to("Log Out", "@sf_guard_signout", array("class"=>"purple-btn"));?>                
            </div>
            <?php endif;?>
        </div>
    </div>
</div>