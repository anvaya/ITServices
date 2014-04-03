<?php use_helper('I18N') ?>
<h2><?php echo __('Hello %name%', array('%name%' => $user->getName()), 'sf_guard') ?></h2>

<h3><?php echo __('Enter your new password in the form below.', null, 'sf_guard') ?></h3>
<br />
<form action="<?php echo url_for('@sf_guard_forgot_password_change?unique_key='.$sf_request->getParameter('unique_key')) ?>" method="POST">
  <?php echo $form->renderHiddenFields();?>  
  <table>
    <tbody>
      <?php foreach($form as $key => $field ):?>
        <?php if($field->isHidden() || $key == "captcha") continue; ?>
        <div class="sf_admin_form_row sf_admin_text">                        
         <div>
             <?php echo $field->renderLabel(); ?>
             <?php echo $field->renderError(); ?>
             <div class="content">
                 <?php echo $field->render(); ?>                            
             </div>
        </div>
     </div>
     <?php endforeach;?>  
    </tbody>
    <tfoot><tr><td colspan="2" align="center"><br /><input class="green-btn" type="submit" name="change" value="<?php echo __('Change', null, 'sf_guard') ?>" /></td></tr></tfoot>
  </table>
</form>