<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
  <body>        
       <div id="main_bg">
        <div id="footer_bg">
            <div id="page_wrapper">
                <div id="page_header">
                    <div id="logo">
                        <a href="#">
                            <?php echo image_tag("logo.png", array("alt"=>"BestBuddies","border"=>0) ); ?>                            
                        </a>
                    </div>
                    <div id="page_header_right">
                        <?php echo link_to("Log out","@sf_guard_signout") ?></div>
                </div>
  
                <?php include("_menu.php");?>

                <div id="content_wrapper">    
                    <div id="main_content" class="wide_content">
                        <?php echo $sf_content;?>
                    </div>
                </div>
                
               <?php include("_footer.php");?>

                
            </div>
        </div>
      </div>
  </body>
</html>