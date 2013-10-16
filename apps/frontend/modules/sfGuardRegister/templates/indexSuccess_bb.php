<?php use_helper('I18N') ?>
<div id="main_content" style="width: 960px;">
<h1><?php echo __('BestBuddies Membership Application', null, 'sf_guard') ?></h1>

<?php echo get_partial('sfGuardRegister/form', array('form' => $form,'sub_form' => $sub_form)) ?>

  <div style="clear:both;"></div>
</div>