<?php use_helper('I18N', 'Date') ?>
<?php include_partial('ticket/assets') ?>

<div id="sf_admin_container">
  <div class="fg-toolbar ui-widget-header ui-corner-all">
      <div class="ui-dialog-title" style="padding: 3px 5px 5px 3px">
          <h1 style="margin-bottom: 0px;">Ask The Expert</h1>
      </div>
  </div>
  

  <?php include_partial('ticket/flashes') ?>

  <div id="sf_admin_header">
    <?php include_partial('ticket/list_header', array('pager' => $pager)) ?>
  </div>


  <div id="sf_admin_content">
    <ul class="sf_admin_actions">
      <?php include_partial('ticket/list_batch_actions', array('helper' => $helper)) ?>
      <?php include_partial('ticket/list_actions', array('helper' => $helper)) ?>
    </ul>
    <?php include_partial('ticket/list', array('pager' => $pager, 'sort' => $sort, 'helper' => $helper)) ?>    
  </div>

  <div id="sf_admin_footer">
    <?php include_partial('ticket/list_footer', array('pager' => $pager)) ?>
  </div>
</div>
