<div class="blue">
<?php if($sf_user->isAuthenticated()):?>
    <ul id="mainmenu" role="navigation" class="mega-menu">        
        <?php 
                $guard_user = $sf_user->getGuardUser(); /* @var $guard_user sfGuardUser */                
                $allowed_agent_menu = array('Home','Activate Member','Logout');

                $menu_items = array(
                                  "Home"=>array("@default","default","index"),                                        
                                  "Activate Member"=>array("member/activateMember","member","index"),
                                  "Members"=>
                                  array(
                                      array(
                                        "Pancard Applications"=>array("@pan_application","pan_application","index"),
                                        "Members"=>array("@member","member","index"),                                        
                                      ),
                                  ),
                                  "Submission"=> array('@submission', 'submission','index'),
                                  "ITR Submissions"=> array('@itr_submission', 'itr','index'),
                                  "Orders"=> array('@order', 'order','index'),
                                  "Settings"=>array(array(
                                      "Settings"=>array("@settings","settings","index"),
                                      "Users"=>array("@sf_guard_user","guard","users"), 
                                      "Groups"=>array("@sf_guard_group","guard","groups"),
                                      "Member Types"=>array("@member_type","member_type","index"),
                                      //"Countries"=>array("@country","country","index"),
                                  )),
                                  "Tickets"=> array('@support_ticket', 'ticket','index'),
                                  "Website"=>array( 
                                           array(                                               
                                            "FAQ's"=>array("@faq","faq","index"),
                                            "News & Events"=>array("@newsnevent","newsnevent","index"),/*
                                            "Slideshows"=>array("@slideshow","slideshow","index"),*/
                                            ),
                                        ),
                                  "Logout"=>array("@sf_guard_signout","sf_guard_auth","signout")    
                              );
        ?> 
         <?php foreach($menu_items as $key=>$item):?>                        
            <?php if(($sf_user->hasCredential('agent') && in_array($key, $allowed_agent_menu)) || $sf_user->hasCredential('super_admin')): ?>
                <li>
                    <?php if(is_array($item[0])):?>
                        <a href="#"><?php echo $key; ?></a>
                        <ul>
                        <?php foreach($item[0] as $subkey=>$subitem):?>
                            <li><?php echo link_to($subkey, $subitem[0]); ?></li>
                        <?php endforeach;?>
                        </ul>
                    <?php else:?>
                        <?php echo link_to($key, $item[0]); ?>
                    <?php endif;?>
                </li>                        
            <?php endif;?>
        <?php endforeach;?>
    </ul>
    <?php endif;?>
</div>


    <?php if($sf_user->isAuthenticated()):?>    
        <br />
        <div align="right" ><strong>Welcome <?php echo $sf_user->getGuardUser()->getFirstName()." ".$sf_user->getGuardUser()->getLastName();?></strong></div>
    <?php endif;?><script type="text/javascript">
    jQuery(document).ready(function()
    {
        jQuery('#mainmenu').dcMegaMenu({
            rowItems: '4',
            speed: 'fast'
        });
    });
</script>    