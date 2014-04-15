<script type="text/javascript" language="javascript">
  <?php if(!$form->isNew() && $form['is_html']->getValue() == 1): ?>
    $("#email_directory_email_templates_plain").parent().hide();  // checked
    $("#email_directory_email_templates").parent().show();  // checked
  <?php else: ?>
    $("#email_directory_email_templates_plain").parent().show();  // checked
    $("#email_directory_email_templates").parent().hide();  // checked
  <?php endif; ?>
jQuery(document).ready(function() {
  <?php if($form->isNew()): ?>
    $("#email_directory_email_templates").parent().hide();  // checked
  <?php endif; ?>
  jQuery('#email_directory_is_html').click(function() {
    //if($('#email_directory_is_html').attr('checked') == "checked") {
    if(this.checked) {
     $("#email_directory_email_templates_plain").parent().hide();  // checked
     $("#email_directory_email_templates").parent().show();  // checked
   } else {
     $("#email_directory_email_templates_plain").parent().show();  // checked
     $("#email_directory_email_templates").parent().hide();  // checked
   }    
  });
});
</script>