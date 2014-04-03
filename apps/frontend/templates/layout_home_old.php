<?php use_helper('JavascriptBase') ?><!doctype html>
<html style="height: 100%">
    <head>
        <?php include_http_metas() ?>
        <?php include_metas() ?>
        <?php include_title() ?>
        <link rel="shortcut icon" href="/favicon.gif" type="image/gif" />
        <?php include_stylesheets() ?>

        <link href='https://fonts.googleapis.com/css?family=Open+Sans+Condensed:700,300,300italic' rel='stylesheet' type='text/css'>
        <!--[if lte IE 8]>
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:700" /> 
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300" /> 
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300italic" />
        <![endif]-->

        <!--[if lt IE 9]>
            <?php echo stylesheet_tag('style_ie6.css'); ?>
            <link rel="stylesheet" type="text/css" href="css/style_ie.css" />
        <![endif]-->
        <!--[if IE 7]>
            <?php echo stylesheet_tag('style_ie7.css'); ?>
            <link rel="stylesheet" type="text/css" href="css/style_ie7.css" />
        <![endif]-->            
        <!--[if lt IE 9]>
            <?php echo javascript_tag("html5.js");?>                
        <![endif]-->
        <!-- Le styles -->            
        <?php include_javascripts() ?>
    </head>
    <body>
        <header>
        <div class="bg-day">
                <div class="wrapper">
                        <div class="head">
                                <div class="logo">
                                        <?php echo image_tag("logo3.jpg", array("border"=>0));?> 						
                                </div>
                                <ul>
                                        <li><a href="/aboutus.html">About Us</a></li>
                                        <li><a href="/services.html">Services</a></li>
                                        <!--
                                        <li><a href="#">Resources</a></li>
                                        <li><a href="#">FAQ</a></li>
                                        
                                        <li><a href="#">Blog</a></li>						
                                        -->
                                        <li><a href="/contactus.html">Contact Us</a></li>						
                                </ul>
                                <div class="search">

                                </div>                            
                                <div class="login">
                                    <?php if($sf_user->isAuthenticated()):?>
                                    <a id="openact" class="purple-btn" href="<?php public_path("member.php");?>">My Account</a>
                                        <a id="openact" class="green-btn" href="<?php echo url_for("@sf_guard_signout");?>">Log Out</a>
                                    <?php else:?>
                                        <a id="openact" class="purple-btn" href="<?php echo url_for("@sf_guard_register");?>">Open Account</a>
                                        <a id="openact" class="green-btn" href="<?php echo public_path("member.php");?>">Login</a>
                                    <?php endif;?>
                                </div>
                        </div>
                </div>

                <div class="container">					
                        <section id="jms-slideshow" class="jms-slideshow">

                                <div id="contact_box" class="jmstep1" style="display: none;">
                                        <?php echo link_to_function(image_tag("chat_icon_new.png", array("alt"=>"Chat Now"))."Chat Now","chatOpen();" );?>                                        
                                        &nbsp;&nbsp;|&nbsp;&nbsp;
                                        <?php echo image_tag("phone_icon_new.png", array("alt"=>"0)- 0000 000 000") );?>(0) 000 000 000                                        
                                </div>


                        <div class="step" data-color="color-1" data-x="1000">
                            <div class="jms-content1">
                                    <h3>Manage your taxes</h3>
                                    <p>Online Helpline for NRI’s</p>
                            </div>
                        </div>

                        <div class="step" data-color="color-2" data-x="2000">
                            <div class="jms-content1">
                                    <h3>Manage your taxes</h3>
                                    <p>PAN Card</p>
                            </div>
                        </div>

                        <div class="step" data-color="color-3" data-x="3000">
                            <div class="jms-content1">
                                    <h3>Manage your taxes</h3>
                                    <p>Filing of Income Tax Return and Maintenance of Records</p>
                            </div>
                        </div>

                        <div class="step" data-color="color-4" data-x="4500">
                            <div class="jms-content1">
                                    <h3>Manage your taxes</h3>
                                    <p>FEMA Consultancy</p>
                            </div>
                        </div>

                        <div class="step" data-color="color-5" data-x="5500">
                            <div class="jms-content1">
                                    <h3>Manage your taxes</h3>
                                    <p>Conversion from NRO a/c to NRE a/c</p>								
                            </div>
                        </div>

                        <div class="step" data-color="color-5" data-x="5500">
                            <div class="jms-content1">
                                    <h3>Manage your taxes</h3>
                                    <p>Certifications / Attestations</p>								
                            </div>
                        </div>        
                        
                        </section>
                </div>

        </div>
</header>
        <?php echo $sf_content ?>
        
        
        <div class="bg_gray">
            <div class="wrapper1">
                    <div class="row-fluid" style="min-height: 180px">
                            <div class="span3">
                                    <h5>Our Services</h5>
                                    <ul class="unstyled">
                                            <li><a href="/services.html">Tax Management</a></li>
                                            <li><a href="/services.html#rbi">FEMA / RBI Services</a></li>
                                            <li><a href="#">Property Management</a></li>
                                            <li><a href="#">Tours and Travels</a></li>
                                    </ul>
                            </div>

                            <div class="span3">
                                    <h5>Why Groworth</h5>
                                    <ul class="unstyled">
                                            <li><a href="/aboutus.html">Advantages</a></li>
                                            <li><a href="/contactus.html">How you can join</a></li>
                                            <li><a href="#">Blog</a></li>
                                    </ul>
                            </div>

                            <div class="span3">
                                    <h5>The Company</h5>
                                    <ul class="unstyled">
                                            <li><a href="/aboutus.html">About Us</a></li>
                                            <li><a href="/contactus.html">Contact us</a></li>
                                            <li><a href="/privacy.html">Privacy policy</a></li>
                                            <li><a href="/terms.html">Terms &amp; conditions</a></li>
                                    </ul>
                            </div>

                            <div class="span3" style="display: none">
                                    <h5>Quick Links</h5>
                                    <ul class="unstyled">
                                            <li><a href="#"></a></li>
                                            <li><a href="#"></a></li>
                                            <li><a href="#"></a></li>
                                            <li><a href="#"></a></li>
                                            <li><a href="#"></a></li>
                                    </ul>
                            </div>									


                    </div>
                    <p style="margin-top: 20px">Copyright &copy; <?php echo date('Y'); ?> Groworth Real Solutions Pvt. Ltd.</p>
            </div>
    </div>	
        
        <script type="text/javascript">
                $(function() 
                {			
                        $( '#jms-slideshow' ).jmslideshow();				
                });
        </script>
        
    </body>
</html>