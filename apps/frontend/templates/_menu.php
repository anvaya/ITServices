<div class="bg-page">
   <div class="wrapper">
        <div class="head">
            <div class="logo">
                <?php echo image_tag("logo3.jpg", array("border"=>0));?>                    					
            </div>
            <ul>
                <li><a href="<?php echo public_path("index.php");?>">Home</a></li>
                <li><a href="<?php echo url_for("content/aboutUs");?>">About Us</a></li>
                <li><a href="<?php echo url_for("content/services");?>">Services</a></li>
                <li><a title="Frequently asked questions" href="<?php echo url_for("faq/index") ?>">FAQs</a></li>
                <li><a href="<?php echo url_for("newsnevent/index");?>">News and Events</a></li>
                <li><a href="<?php echo url_for("default/contact");?>">Contact Us</a></li>						
            </ul>
            <div class="login">
                
                    
            </div>
            <div class="search">
            </div>            
            
            <div class="login">                
                <?php if($sf_user->isAuthenticated()):?>
                    <a id="openact" class="purple-btn" href="<?php echo public_path("member.php");?>">My Account</a>
                    <?php echo link_to("Log Out", "@sf_guard_signout", array("class"=>"purple-btn"));?>                            
                <?php else:?>
                    <a id="openact" class="purple-btn" href="<?php echo url_for("@sf_guard_register");?>">Open Account</a>
                    <a id="openact" class="green-btn" href="<?php echo public_path("member.php");?>" >Login</a>
                <?php endif;?>
            </div>
        </div>
    </div>
</div>