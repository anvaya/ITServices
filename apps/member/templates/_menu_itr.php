<div class="bg-page">
   <div class="wrapper">
       <div class="head">
           <div style="display: inline-block">
               <div class="logo" style="position: absolute; top: 0px; left: 0px;">
                    <?php echo image_tag("logo3.jpg", array("border"=>0));?>                    					
                </div>
           </div>
           <div style="display: inline-block; margin-left: 180px">
               <?php include(dirname(__FILE__)."/_menu_bar.php");?>                   
           </div>
           <div style="display: inline-block">
               <?php if($sf_user->isAuthenticated()):?>
                       <div class="login">
                           <?php echo link_to("Log Out", "@sf_guard_signout", array("class"=>"purple-btn"));?>                
                       </div>
               <?php endif;?>
           </div>
       </div>
   </div>
</div>