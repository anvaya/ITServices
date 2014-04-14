<?php $sf_response->addJavascript('tinymce/tiny_mce.js'); ?>
<?php if ($field->isPartial()): ?>
  <?php include_partial('email_directory/'.$name, array('form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?>
<?php elseif ($field->isComponent()): ?>
  <?php include_component('email_directory', $name, array('form' => $form, 'attributes' => $attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes)) ?>
<?php else: ?>
  <div class="<?php echo $class ?><?php $form[$name]->hasError() and print ' ui-state-error ui-corner-all' ?>">
    <div class="label ui-helper-clearfix">
      <?php echo $form[$name]->renderLabel($label) ?>

      <?php if ($help || $help = $form[$name]->renderHelp()): ?>
        <div class="help">
          <span class="ui-icon ui-icon-help floatleft"></span>
          <?php echo __(strip_tags($help), array(), 'messages') ?>
        </div>
      <?php endif; ?>
    </div>
    <?php if($name == 'send_to_list'): ?>
      <?php //echo $form[$name]->render($attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes) ?>
      <table>
        <tbody>
          <tr>
            <td>Name</td>
            <td>Email</td>
          </tr>
          <?php foreach($form[$name] as $key=>$subform):?>
              <?php include_partial("email_directory/subform",array("key"=>$key, "item"=>$subform));?>
         <?php endforeach;?>   
        </tbody>        
      </table>
    <?php else: ?>
      <?php echo $form[$name]->render($attributes instanceof sfOutputEscaper ? $attributes->getRawValue() : $attributes) ?>
    <?php endif; ?>
    
    <?php if ($form[$name]->hasError()): ?>
      <div class="errors">
        <span class="ui-icon ui-icon-alert floatleft"></span>
        <?php echo $form[$name]->renderError() ?>
      </div>
    <?php endif; ?>
  </div>
<?php endif; ?>
