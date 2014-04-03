<!doctype html>
<html style="height: 100%">
	<head>
            <?php include_http_metas() ?>
            <?php include_metas() ?>
            <?php include_title() ?>
            <link rel="shortcut icon" href="/favicon.gif" type="image/gif" />
            
            <link href="http://fonts.googleapis.com/css?family=Open+Sans+Condensed:700,300,300italic" rel="stylesheet" type="text/css">
            <link rel="stylesheet" href="<?php echo public_path("css/main.css");?>" type="text/css"></link>
            <link rel="stylesheet" href="<?php echo public_path("css/media.css");?>" type="text/css"></link>
            

            <!--[if lt IE 9]>
		<link rel="stylesheet" type="text/css" href="<?php echo public_path("css/style_ie.css");?>" />
		<![endif]-->
            <!--[if IE 7]>
		<link rel="stylesheet" type="text/css" href="<?php echo public_path("css/style_ie7.css");?>" />
		<![endif]-->
            <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
		<!--[if lt IE 9]>
		<script type="text/javascript" 	src="<?php echo public_path("js/html5.js");?>"></script>
		<![endif]-->
		<!-- Le styles -->

		<script type="text/javascript" src="<?php echo public_path("js/jquery-latest.min.js");?>"></script>	
		<script type="text/javascript" src="<?php echo public_path("js/jquery.min.js");?>"></script>
		<script type="text/javascript" src="<?php echo public_path("js/jmpress.min.js");?>"></script>

		<noscript>
			<style>
			.step {
				width: 100%;
				position: relative;
				
			}
			.step:not(.active) {
				opacity: 1;
				filter: alpha(opacity=99);
				-ms-filter: "progid:DXImageTransform.Microsoft.Alpha(opacity=99)";
			}
			.step:not(.active) a.jms-link{
				opacity: 1;
				margin-top: 40px;
			}
			</style>
		</noscript>

		<script type="text/javascript" src="<?php echo public_path("js/jquery.jmslideshow.js");?>"></script>
		<script type="text/javascript" src="<?php echo public_path("js/modernizr.custom.48780.js");?>"></script>

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
                                                    <li><a href="<?php echo url_for("content/aboutUs"); ?>">About Us</a></li>
                                                    <li><a href="<?php echo url_for("content/services"); ?>">Services</a></li>
                                                    <li><a href="<?php echo public_path("index.php");?>/faq">FAQ</a></li>
                                                    <li><a href="<?php echo public_path("index.php");?>/newsnevent">News and Events</a></li>
							<!--
							<li><a href="#">Resources</a></li>
							<li><a href="#">FAQ</a></li>							
							<li><a href="#">Blog</a></li>						
                                                        -->
							<li><a href="<?php echo url_for("default/contact") ?>">Contact Us</a></li>						
						</ul>
						<div class="search">
							
						</div>
						<div class="login">
							<a id="openact" class="purple-btn" href="<?php echo url_for("@sf_guard_register");?>">Open Account</a>
							<a id="openact" class="green-btn" href="<?php echo public_path("member.php");?>" >Login</a>
						</div>
					</div>
				</div>

				<div class="container">					
					<section id="jms-slideshow" class="jms-slideshow">
						
                                        <div id="contact_box" class="jmstep1" style="display: none">
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
		<div class="wrapper1" style="text-align: center">
                        <img src="images/tax01.png" style="height: 500px;" alt="NRI Tax Services" />			
		</div>

		<div class="wrapper1" style="min-height: 180px; display: none;">
			<div class="row-fluid">
				<!--
				<div class="span4 span4-color1" style="height: 336px">
					<img src="images/travel.jpg" width="271px" border="0" />
					<h4>Tours and Travel</h4>
					<p>Coming Soon...</p>
					<p><a href="#" class="white-btn read-more">Coming Soon...</a></p>
				</div>

				<div class="span4 span4-color2" style="height: 336px">
					<img src="images/pm.jpg" width="271px" height="180px" border="0" style="border-bottom: 1px solid #eee" />
					<h4>Property Management</h4>
					<p>Coming Soon...</p>
					<p><a href="#" class="white-btn read-more">Coming Soon...</a></p>
				</div>
				
				<div class="span4" style="height:150px;">
					<h4 style="color:#426DAD;">Connect with us!</h4>
					<p>Follow us to learn more about our value-added features, and to catch the latest news!</p>
					<p><a href="https://www.facebook.com/" target="_blank"><img src="images/facebook.gif" alt="Facebook"></a> <a href="https://www.twitter.com/" target="_blank"><img src="images/twitter.gif" alt="Twitter"></a> <a href="https://www.linkedin.com/groups/" target="_blank"><img src="images/in.gif" alt="Linkedin"></a> <a href="http://www.youtube.com/" target="_blank"><img src="images/you.gif" alt="Youtube"></a></p>
				</div>
                                -->
			</div>
		</div>
		
		<div class="bg_gray">
                        <div class="wrapper1">
                                <div class="row-fluid" style="min-height: 180px">
                                        <div class="span3">
                                                <h5>Our Services</h5>
                                                <ul class="unstyled">
                                                        <li><a href="<?php echo url_for("content/services"); ?>" >Tax Management</a></li>
                                                        <li><a href="<?php echo url_for("content/services"); ?>#rbi">FEMA / RBI Services</a></li>
                                                        <li><a href="#">Property Management</a></li>
                                                        <li><a href="#">Tours and Travels</a></li>
                                                </ul>
                                        </div>

                                        <div class="span3">
                                                <h5>Why Groworth</h5>
                                                <ul class="unstyled">
                                                        <li><a href="<?php echo url_for("content/aboutUs"); ?>">Advantages</a></li>
                                                        <li><a href="<?php echo url_for("default/contact") ?>">How you can join</a></li>
                                                        <!--
                                                        <li><a href="#">Blog</a></li>
                                                        -->
                                                </ul>
                                        </div>

                                        <div class="span3">
                                                <h5>The Company</h5>
                                                <ul class="unstyled">
                                                        <li><a href="<?php echo url_for("content/aboutUs"); ?>">About Us</a></li>
                                                        <li><a href="<?php echo url_for("default/contact") ?>">Contact us</a></li>
                                                        <!--
                                                        <li><a href="<?php echo public_path("privacy.html");?>">Privacy policy</a></li>
                                                        <li><a href="<?php echo public_path("terms.html");?>">Terms &amp; conditions</a></li>
                                                        -->
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