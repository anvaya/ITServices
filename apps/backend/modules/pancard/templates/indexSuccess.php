<?php use_helper('I18N', 'Date') ?>
<?php use_stylesheet('/sfAdminThemejRollerPlugin/css/reset.css', 'first') ?>

<?php use_javascript('/sfAdminThemejRollerPlugin/js/jquery.min.js', 'first') ?>
<?php use_javascript('/sfAdminThemejRollerPlugin/js/jquery-ui.custom.min.js', 'first') ?>

<?php use_stylesheet('/sfAdminThemejRollerPlugin/css/jquery/redmond/jquery-ui.custom.css') ?>

<?php use_stylesheet('/sfAdminThemejRollerPlugin/css/jroller.css') ?>

<?php // additionnal stylesheet (filament group)
  use_stylesheet('/sfAdminThemejRollerPlugin/css/fg.menu.css');
  use_stylesheet('/sfAdminThemejRollerPlugin/css/fg.buttons.css');
  use_stylesheet('/sfAdminThemejRollerPlugin/css/ui.selectmenu.css');
?>

<?php // additionnal javascript (filament group)
  use_javascript('/sfAdminThemejRollerPlugin/js/fg.menu.js');
  use_javascript('/sfAdminThemejRollerPlugin/js/jroller.js');
  use_javascript('/sfAdminThemejRollerPlugin/js/ui.selectmenu.js');
?>


<div id="sf_admin_container">
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

  <div id="sf_admin_header">&nbsp;</div>

  <div id="sf_admin_bar ui-helper-hidden" style="display:none">&nbsp;</div>
  
  <div id="sf_admin_content">
    

      <?php include_partial('pancard/list', array('pager' => $pager, 'sort' => $sort)) ?>

  </div>

  <div id="sf_admin_footer">&nbsp;</div>

  <?php include_partial('pancard/themeswitcher') ?>
</div>
