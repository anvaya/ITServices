<?php use_helper('I18N') ?>
<div id="main_content">
<h1><?php echo __('Register With Us', null, 'sf_guard') ?></h1>
<h5>Please complete and submit the following registration form. Fields marked with a <span class="mandatory">* </span> are mandatory. </h5>
<?php echo get_partial('sfGuardRegister/form', array('form' => $form)) ?>
</div>