<?php use_helper('I18N') ?>

<form action="<?php echo url_for('@sf_guard_signin') ?>" method="post">
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
        
      <?php //echo $form ?>
    </tbody>
    <tfoot>
      <tr>
        <td colspan="2">
          <input class="green-btn" type="submit" value="<?php echo __('Log In', null, 'sf_guard') ?>" />
          
          <?php $routes = $sf_context->getRouting()->getRoutes() ?>
          <?php if (isset($routes['sf_guard_forgot_password'])): ?>
            <a class="forgot_pwd_link" href="<?php echo url_for('@sf_guard_forgot_password') ?>"><?php echo __('Forgot your password?', null, 'sf_guard') ?></a>
          <?php endif; ?>

          <?php if (isset($routes['sf_guard_register'])): ?>
            &nbsp; <a href="<?php echo url_for('@sf_guard_register') ?>"><?php echo __('Want to register?', null, 'sf_guard') ?></a>
          <?php endif; ?>
        </td>
      </tr>
    </tfoot>
  </table>
</form>