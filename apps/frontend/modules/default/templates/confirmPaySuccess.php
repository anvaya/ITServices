<?php use_helper('I18N') ?>
<div id="main_content" style="width: 960px;">
<h1 style="font-size: 18px;" ><?php echo __('Details of your Subscription Payment', null, 'messages') ?></h1>
<?php if ($form->hasErrors()): ?>
    <div class="error">Your payment receipt could not be recorded due to some errors.</div>
    <?php /*
    <?php foreach($form->getWidgetSchema()->getPositions() as $widgetName): ?>
        <?php if($form[$widgetName]->hasError()): ?>
        <p><?php echo $form[$widgetName]->renderLabelName().': '.$form[$widgetName]->getError()->getMessageFormat(); ?></p>
        <?php endif; ?>
    <?php endforeach; ?>
     * 
     */?>
<?php endif; ?>
<?php echo $form->renderGlobalErrors(); ?> 
<div style="clear:both;"></div>
<?php if(isset($flg) && $flg != ""): ?>
    <fieldset id="sf_fieldset_none" class="payment_verified">
      <?php echo html_entity_decode($flg); ?>
    </fieldset>
<?php else: ?>
<form action="<?php echo url_for('default/confirmPayUpdate') ?>" method="post" onsubmit="return validateForm()" >    
  <input type="hidden" name="verify" value="<?php echo $sf_request->getParameter('verify'); ?>" />
    <fieldset id="sf_fieldset_none" class="payment_verified">
        <?php foreach($form as $name => $field ): ?>
          <?php if ((isset($form[$name]) && $form[$name]->isHidden()) || (!isset($form[$name]) && $field->isReal())) continue ?>
          <div class="sf_admin_form_row sf_admin_text">              
              <div>
                  <?php echo $field->renderLabel(); ?>
                  <div class="content">
                      <?php echo $field->render(); ?>                            
                      <?php echo $field->renderError(); ?>
                  </div>                  
              </div>              
          </div>
        <?php endforeach; ?>
        <div class="sf_admin_form_row sf_admin_text">
			<div>
			  <label>&nbsp;</label>
			  <div class="content">
				<?php echo $form->renderHiddenFields(); ?>
				<input type="submit" class="green-btn" name="register" value="Submit" onclick="return validateForm();" />
			  </div>
			</div>
        </div>
      <div style="clear:both;height: 30px;">&nbsp;</div>
    </fieldset>
</form>
<?php endif; ?>
<div style="clear:both;"></div>
</div>
<script type="text/javascript">
   function validateForm()
   {
      var err = "";
      var name, value;
      var err_flg = 0;
      $('input.required').each(function()
      {
          if($this.attr('id') == "payment_routed_through") return;
          if($(this).attr('type')=="hidden") return;
          if($(this).attr('type') != 'text' && $(this).attr('type') != 'textarea') return;
          name = $(this).attr('name');
          value = $(this).val();    
 
          var ul_id = $('#error_list_'+ $(this).attr('qid'));
           
          if($.trim(value) === "")
          {            
               var id = $(this).attr('id');   
               var err = errormsg($(this).attr('id'),'select');
               var ul_id = $('#error_list_'+ $(this).attr('qid'));
               $('li', ul_id).html(err);
               $(ul_id).show();
               err_flg = 1;            
          }
          else
              $(ul_id).hide();

      });

      if(err_flg === 1)
        return false;
    }
 
    function errormsg(field_id,field_type)
    {
        var err = "";
        var _attr = $('#'+field_id).attr('error_msg');
        if(typeof _attr !== "undefined" && _attr !== false && _attr !== null){
          err = $('#'+field_id).attr('error_msg');
        }
        if(err === "")
        {
          err = "Field cannot left blank";
        }

        return err;
    }    

</script>