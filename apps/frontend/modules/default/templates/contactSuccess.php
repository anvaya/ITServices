<div class="wrapper1">
    <div class="row-fluid" style="min-height: 366px;">
        
      <div class="span6 span4-color1">
        <h4><?php echo "Contact" ?></h4>
	<?php /*if ($form->hasErrors()): ?>
	    <p>The form has some errors you need to fix.</p>
	    <?php foreach($form->getWidgetSchema()->getPositions() as $widgetName): ?>
		<?php if($form[$widgetName]->hasError()): ?>
		<p><?php echo $form[$widgetName]->renderLabelName().': '.$form[$widgetName]->getError()->getMessageFormat(); ?></p>
		<?php endif; ?>
	    <?php endforeach; ?>
	<?php endif; ?>
	<?php echo $form->renderGlobalErrors(); */ ?> 
	<form action="<?php echo url_for('default/contact') ?>" method="post">    
        <?php foreach($form as $key => $field ):?>
           <?php if($field->isHidden() || $key == "captcha") continue; ?>
	   <div class="sf_admin_form_row sf_admin_text">
	    <?php echo $field->renderError(); ?>
	    <div>
		<?php echo $field->renderLabel(); ?>
		<div class="content">
		    <?php echo $field->render(); ?>                            
		</div>
	   </div>
	</div>
        <?php endforeach;?>
	      <div class="sf_admin_form_row sf_admin_text">
		<div>
		  <label>&nbsp;</label>
		  <div class="content">
		    <?php echo $form->renderHiddenFields(); ?>
		    <input type="submit" class="green-btn" name="send" value="Submit"/>
		  </div>
		</div>
	      </div>
	</form>
      </div>

      <div class="span4 span4-color2">
        <?php echo html_entity_decode($content); ?>
      </div>

    </div>
</div>
                