<div id="dialog">
  <div class="sf_admin_flashes ui-widget" style="display: none;">
    <div id="info" class="notice ui-state-highlight ui-corner-all"></div>
  </div>
  <div class="sf_admin_form">
    <form method="post" action="<?php echo url_for('blog/sendNewsletter'); ?>">
      <div class="sf_admin_form_row sf_admin_text">
        <div class="label ui-helper-clearfix">
          <label>Send email as</label>
        </div>
        <select name="sendas" id="sendas">
          <option value="">Select</option>
          <option value="1">Send Summary</option>
          <option value="2">Send Full</option>
        </select>
      </div>
      <div class="sf_admin_form_row sf_admin_action_save">
        <input type="hidden" name="blog_id" id="blog_id" value="" />
      </div>
    </form>
  </div>
</div>
<script type="text/javascript">
jQuery("#dialog").dialog({ autoOpen: false });
jQuery(document).ready(function() {
  jQuery( "#dialog" ).dialog({
    autoOpen: false,
    title: 'Send As News Letter',
    resizable: false,
    height:240,
    width:400,
    modal: true,
    buttons: {
      "Send": function() {
        if($('#sendas').val() == "" )
        {
          alert("Please select news letter send type");
          return false;
        }
        jQuery.ajax({
          type: 'POST',
          url: '<?php echo url_for("blog/sendNewsletter") ?>',
          data: "blog_id="+$("#dialog").data("blog_id")+"&sendas="+$('#sendas').val(),
          success: function (data) {
            console.log(data);
            jQuery('#info').parent().show();
            jQuery('#info').html(data);
          }
        });        
      },
      Cancel: function() {
        jQuery( this ).dialog( "close" );
      }
    }
  });  
});
function sendAsNewsletter(url)
{
  var arr_url = url.split("/");
  jQuery('#dialog')
          .data('blog_id', arr_url[5])
          .dialog('open');
}
</script>
