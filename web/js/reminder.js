$(document).ready(function(){

  if(jQuery("#reminder_alert_type").val() == 1)
  {
    jQuery(".sf_admin_form_field_survey_id").show();
    jQuery(".sf_admin_form_field_submission_form_id").hide();
    jQuery("#reminder_submission_form_id").val("");
  }
  else if(jQuery("#reminder_alert_type").val() == 2)
  {
    jQuery(".sf_admin_form_field_submission_form_id").show();
    jQuery(".sf_admin_form_field_survey_id").hide();
    jQuery("#reminder_survey_id").val("");
  }else{
    jQuery(".sf_admin_form_field_survey_id").hide();
    jQuery(".sf_admin_form_field_submission_form_id").hide();
    jQuery("#reminder_submission_form_id").val("");
    jQuery("#reminder_submission_form_id").val("");
  }
  
  jQuery("#reminder_alert_type").change(function(){
    if(jQuery(this).val() == 1)
    {
      jQuery(".sf_admin_form_field_survey_id").show();
      jQuery(".sf_admin_form_field_submission_form_id").hide();
      jQuery("#reminder_submission_form_id").val("");
    }
    else if(jQuery(this).val() == 2)
    {
      jQuery(".sf_admin_form_field_submission_form_id").show();
      jQuery(".sf_admin_form_field_survey_id").hide();
      jQuery("#reminder_survey_id").val("");
    }else{
      jQuery(".sf_admin_form_field_survey_id").hide();
      jQuery(".sf_admin_form_field_submission_form_id").hide();
      jQuery("#reminder_submission_form_id").val("");
      jQuery("#reminder_submission_form_id").val("");
    }
  })
  
  if(jQuery("#reminder_filters_alert_type").val() == 1)
  {
    jQuery(".sf_admin_filter_field_survey_id").show();
    jQuery(".sf_admin_filter_field_submission_form_id").hide();
    jQuery("#reminder_filters_submission_form_id").val("");
  }
  else if(jQuery("#reminder_filters_alert_type").val() == 2)
  {
    jQuery(".sf_admin_filter_field_submission_form_id").show();
    jQuery(".sf_admin_filter_field_survey_id").hide();
    jQuery("#reminder_filters_survey_id").val("");
  }else{
    jQuery(".sf_admin_filter_field_survey_id").hide();
    jQuery(".sf_admin_filter_field_submission_form_id").hide();
    jQuery("#reminder_filters_survey_id").val("");
    jQuery("#reminder_filters_submission_form_id").val("");
  }
  
  jQuery("#reminder_filters_alert_type").change(function(){
    if(jQuery(this).val() == 1)
    {
      jQuery(".sf_admin_filter_field_survey_id").show();
      jQuery(".sf_admin_filter_field_submission_form_id").hide();
      jQuery("#reminder_filters_submission_form_id").val("");
    }
    else if(jQuery(this).val() == 2)
    {
      jQuery(".sf_admin_filter_field_submission_form_id").show();
      jQuery(".sf_admin_filter_field_survey_id").hide();
      jQuery("#reminder_filters_survey_id").val("");
    }else{
      jQuery(".sf_admin_filter_field_survey_id").hide();
      jQuery(".sf_admin_filter_field_submission_form_id").hide();
      jQuery("#reminder_filters_survey_id").val("");
      jQuery("#reminder_filters_submission_form_id").val("");
    }
  })

});