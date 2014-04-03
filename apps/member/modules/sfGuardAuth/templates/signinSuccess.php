<?php use_helper('I18N') ?>
<style type="text/css">
    
    #login_box
    {
        border: 1px solid #ddd;
        padding: 20px;
        width: 600px;
    }
    
    ul.login_options
    {
        list-style-type:  none;        
        border-bottom: 1px solid #dddddd;
        margin-bottom: 20px;    
    }
    
    ul.login_options li
    {
        font-size: 1.3em;
        font-weight: bold;
        display: inline-block;                  
        padding: 4px;
        margin-bottom: -5px
    }
    
    ul.login_options li.active
    {
        /*
        border-right: 1px solid #ccc;
        border-left: 1px solid #ccc;
        border-top: 1px solid #ccc;
        border-bottom: 1px solid #fff;
        */
    }
    
    ul.login_options > li > a 
    {
        margin-right: 2px;
        line-height: 1.428571429;
        border: 1px solid transparent;
        border-radius: 4px 4px 0 0;
    }
    
    ul.login_options > li > a 
    {
        position: relative;
        display: block;
        padding: 10px 15px;
        text-decoration: none;
        color: #004BAD;
    }   
    
    
    ul.login_options > li.active > a, 
    ul.login_options > li.active > a:hover, 
    ul.login_options > li.active > a:focus 
    {
        text-decoration: none;
        color: #555555;
        background-color: #ffffff;
        border: 1px solid #dddddd;
        border-bottom-color: transparent;
        cursor: default;
    }
    
    a.forgot_pwd_link, a.forgot_pwd_link:active, a.forgot_pwd_link:focus
    a.forgot_pwd_link:visited
    {
        color: #000;
        font-weight: bold;
        text-decoration: none;
    }
</style>
<?php ?>
<h1><?php echo __('Member Login', null, 'sf_guard') ?></h1>

<br />
<div class="sf_admin_flashes ui-widget">
<?php if ($sf_user->hasFlash('notice')): ?>
  <div class="notice ui-state-highlight ui-corner-all">
    <span class="ui-icon ui-icon-info floatleft"></span>&nbsp;
    <?php echo __($sf_user->getFlash('notice'), array(), 'sf_admin') ?>
  </div>
<?php endif; ?>

<?php if ($sf_user->hasFlash('error')): ?>
  <div class="error ui-state-error ui-corner-all">
    <span class="ui-icon ui-icon-alert floatleft"></span>&nbsp;
    <?php echo __($sf_user->getFlash('error'), array(), 'sf_admin') ?>
  </div>
<?php endif; ?>
</div>

<div id="login_box">    
    <ul class="login_options">
        <li><a href="<?php echo public_path("index.php/guard/register") ?>">OPEN ACCOUNT</a></li>
        <li class="active"><a href="#">LOGIN</a></li>
    </ul>
    <?php echo get_partial('sfGuardAuth/signin_form', array('form' => $form)) ?>
</div>
