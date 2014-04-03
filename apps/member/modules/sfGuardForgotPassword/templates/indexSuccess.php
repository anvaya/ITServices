<?php use_helper('I18N') ?>
<p>&nbsp;</p>
<h2><?php echo __('Forgot your password?', null, 'sf_guard') ?></h2>
<hr />
<p></p>
<p style="text-align: left">
  <?php echo __('Do not worry, we can help you get back in to your account safely!', null, 'sf_guard') ?>
</p>
<p style="text-align: left">
  <?php echo __('Fill out the form below to request an e-mail with information on how to reset your password.', null, 'sf_guard') ?>
</p>

<form action="<?php echo url_for('@sf_guard_forgot_password') ?>" method="post">
  <table>
    <tbody>
      <?php echo $form ?>
    </tbody>
    <tfoot><tr><td colspan="2" align="center">
            <p>&nbsp;</p>
            <input class="green-btn" type="submit" name="change" value="<?php echo __('Request', null, 'sf_guard') ?>" /></td></tr></tfoot>
  </table>
</form>