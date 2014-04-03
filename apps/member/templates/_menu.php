<div class="bg-page">
   <div class="wrapper">
        <div class="head">
            <div class="logo">
                <?php echo image_tag("logo3.jpg", array("border"=>0));?>                    					
            </div>
            <?php include(dirname(__FILE__)."/_menu_bar.php");?>     
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