<td class="sf_admin_text sf_admin_list_td_id">
  <?php echo $submission->getId(); ?>
  <?php //echo link_to($submission->getId(), 'submission_edit', $submission) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_submission_form">
  <?php echo $submission->getSubmissionForm() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_sfGuardUser">
  <?php echo $submission->getSfGuardUser() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_ip_address">
  <?php echo $submission->getIpAddress() ?>
</td>
<td class="sf_admin_boolean sf_admin_list_td_archieved">
  <?php echo get_partial('submission/list_field_boolean', array('value' => $submission->getArchieved())) ?>
</td>
<td class="sf_admin_date sf_admin_list_td_created_at">
  <?php echo false !== strtotime($submission->getCreatedAt()) ? format_date($submission->getCreatedAt(), "f") : '&nbsp;' ?>
</td>
<td>
  <?php 
    $name = $phone = $email = "";
    $name_arr = array(1,2,3,4);
    $phone_arr = array(37,38,39);
    foreach($submission->getSubmissionData()as $data)
    {
      if(in_array($data->getQuestionId(),$name_arr))
              $name .= $data->getAnswserText()." ";
      if(in_array($data->getQuestionId(),$phone_arr))
              $phone .= $data->getAnswserText()." ";
      if($data->getQuestionId() == 40)
            $email .= $data->getAnswserText();
    }
    if($name != "")
      echo $name."<br/>";
    if($phone != "")
      echo $phone."<br/>";
    if($phone != "")
      echo $email."<br/>";
    
  ?>
</td>