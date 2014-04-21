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
            <link rel="stylesheet" type="text/css" href="<?php echo public_path("css");?>/style_ie.css" />
        <![endif]-->
        <!--[if IE 7]>
            <?php echo stylesheet_tag('style_ie7.css'); ?>
            <link rel="stylesheet" type="text/css" href="<?php echo public_path("css");?>/style_ie7.css" />
        <![endif]-->            
        <!--[if lt IE 9]>
            <script type="text/javascript" src="<?php echo public_path("js/html5.js");?>"></script>
        <![endif]-->
        <!-- Le styles -->            
        <?php include_javascripts() ?>
    </head>
    <body>
        <header>
            <?php include(dirname(__FILE__)."/_menu_itr.php");?>
        </header>
        
        <div id="page_content" class="wrapper1">            
            <?php echo $sf_content ?>
        </div>        
        
        <footer id="page_footer">            
            <?php include("_footer.php");?>	    
        </footer>
        <script type="text/javascript">
            $(document).ready(function () {
                var theme = "";                
                $('#jqxWidget').jqxMenu();                
            });
        </script>

    </body>
</html>