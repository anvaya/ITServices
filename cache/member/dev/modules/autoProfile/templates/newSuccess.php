<?php use_helper('I18N', 'Date') ?>
<?php include_partial('profile/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('New Profile', array(), 'messages') ?></h1>

  <?php include_partial('profile/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('profile/form_header', array('member' => $member, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>

  <div id="sf_admin_content">
    <?php include_partial('profile/form', array('member' => $member, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('profile/form_footer', array('member' => $member, 'form' => $form, 'configuration' => $configuration)) ?>
  </div>
</div>
