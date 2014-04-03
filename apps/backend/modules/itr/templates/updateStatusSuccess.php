<?php use_helper('I18N', 'Date') ?>
<?php include_partial('itr/assets') ?>

<div id="sf_admin_container" id="dialog-form">
  <?php include_partial('itr/flashes') ?>
  <div id="sf_admin_content">
    <div class="sf_admin_list ui-grid-table ui-widget ui-corner-all ui-helper-reset ui-helper-clearfix">
      <form action="<?php url_for('itr/updateStatus?id='.$sf_params->get('id')) ?>" method="post">
        <table>
          <?php echo $status_form ?>
        </table>
        <div class="sf_admin_actions_block ui-widget ui-helper-clearfix">
          <input type="hidden" name="id" value="<?php echo $sf_params->get('id'); ?>" />
            <button class="fg-button ui-state-default fg-button-icon-left" type="submit"><span class="ui-icon ui-icon-circle-check"></span>Save</button>
            <a href="<?php echo url_for('@itr_submission') ?>" class="fg-button ui-state-default fg-button-icon-left"><span class="ui-icon ui-icon-arrowreturnthick-1-w"></span>Back to list</a>
        </div>    
      </form>  
    </div>    
  </div>  
</div>
