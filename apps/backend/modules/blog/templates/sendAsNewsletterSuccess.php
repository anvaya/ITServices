<?php use_helper('I18N'); ?>

  <?php use_stylesheet('/css/redmond/jquery-ui.custom.css') ?>

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


<div id="sf_admin_container" class="sf_admin_edit ui-widget ui-widget-content ui-corner-all">
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
  <div id="sf_admin_content">
    <div class="sf_admin_form">
      <form method="post" action="<?php echo url_for('blog/sendNewsletter'); ?>">
        <div class="sf_admin_form_row sf_admin_text">
          <div class="label ui-helper-clearfix">
            <label>Send email as</label>
          </div>
          <select name="sendas">
            <option value="">Select</option>
            <option value="1">Send Summary</option>
            <option value="2">Send Full</option>
          </select>
        </div>
        <div class="sf_admin_form_row sf_admin_action_save">
          <input type="hidden" name="id" value="<?php echo $sf_request->getParameter('id'); ?>" />
          <input type="submit" value="send now" class="fg-button ui-state-default fg-button-icon-left" />
        </div>
      </form>
    </div>
  </div>
</div>