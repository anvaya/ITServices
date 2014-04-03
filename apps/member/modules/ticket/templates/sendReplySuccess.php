<?php use_helper('I18N', 'Date') ?>
<?php include_partial('ticket/assets') ?>

<div id="sf_admin_container" >
  <div class="fg-toolbar ui-widget-header ui-corner-all">
      <div style="padding: 3px 5px 5px 3px" class="ui-dialog-title"><?php echo __('Send Reply', array(), 'messages') ?></div>
  </div>

  <?php include_partial('ticket/flashes') ?>

  <div id="sf_admin_header">&nbsp;</div>

  <div id="sf_admin_content">
    <?php include_stylesheets_for_form($form) ?>
    <?php include_javascripts_for_form($form) ?>

    <div class="sf_admin_form">
      <form action="<?php echo url_for('@supportticket_sendreply?id='.$sf_params->get('id')) ?>" method="post">
        <fieldset id="sf_fieldset_none">
          <?php foreach($form as $key => $field ): ?>
            <?php if($field->isHidden()) continue; ?>
              <div class="sf_admin_form_row sf_admin_text">
                  <?php echo $field->renderError(); ?>
                  <div>
                      <?php echo $field->renderLabel(); ?>
                      <ul class="error_list" style="display: none;">
                          <li></li>
                      </ul>
                      <div class="content">
                          <?php echo $field->render(array("rows"=>"10","cols"=>60)); ?>                                                 </div>
                  </div>
              </div>
          <?php endforeach; ?>                
          
          </div>          
        </fieldset>
        <ul class="sf_admin_actions">
            <li class="sf_admin_action_list"><a href="<?php echo url_for("@support_ticket") ?>" style="background: #dfeffc url(/css/redmond/images/ui-bg_glass_85_dfeffc_1x400.png) 50% 50% repeat-x" class="fg-button ui-state-default fg-button-icon-left"><span class="ui-icon ui-icon-arrowreturnthick-1-w"></span>Back</a></li>  
            <li class="sf_admin_action_save"><input type="submit" name="sendreply" class="green-btn" value="Send Reply" /></li>
          </ul>  

          <?php echo $form->renderHiddenFields(); ?>               
            
        <div style="clear:both;height: 30px;">&nbsp;</div>  
      </form>
  </div>
    
  </div>

  <div id="sf_admin_footer">&nbsp;</div>

</div>
