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
            <?php include(dirname(__FILE__)."/_menu.php");?>
        </header>
        <?php echo $sf_content ?>
        
        
        <div class="bg_gray">
            <div class="wrapper1">
                    <div class="row-fluid" style="min-height: 180px">
                            <div class="span3">
                                    <h5>Our Services</h5>
                                    <ul class="unstyled">
                                            <li><a href="<?php echo url_for("content/services"); ?>">Tax Management</a></li>
                                            <li><a href="<?php echo url_for("content/services"); ?>#rbi">Online Helpline for NRI’s</a></li>
                                            <li><a href="<?php echo url_for("content/services"); ?>#rbi">Conversion from NRO a/c to NRE a/c</a></li>														
                                            <li><a href="<?php echo url_for("content/services"); ?>#rbi">Certifications / Attestations</a></li>
                                    </ul>
                            </div>

                            <div class="span3">
                                    <h5>Why Groworth</h5>
                                    <ul class="unstyled">
                                            <li><a href="<?php echo url_for("content/aboutUs"); ?>">Advantages</a></li>
                                            <li><a href="<?php echo url_for("default/contact");?>">How you can join</a></li>
                                            <!-- <li><a href="#">Blog</a></li> -->
                                    </ul>
                            </div>

                            <div class="span3">
                                    <h5>The Company</h5>
                                    <ul class="unstyled">
                                            <li><a href="<?php echo url_for("content/aboutUs"); ?>">About Us</a></li>
                                            <li><a href="<?php echo url_for("default/contact");?>">Contact us</a></li>
                                            <li style="display: none"><a href="#">Privacy policy</a></li>
                                            <li style="display: none"><a href="#">Terms &amp; conditions</a></li>
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
                    <p style="margin-top: 20px">Copyright &copy; <?php echo date('Y');?> Groworth Real Solutions Pvt. Ltd.</p>
            </div>
        </div>	
        
    </body>
</html>