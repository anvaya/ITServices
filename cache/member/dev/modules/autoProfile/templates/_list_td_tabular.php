<td class="sf_admin_text sf_admin_list_td_id">
  <?php echo link_to($member->getId(), 'member_edit', $member) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_first_name">
  <?php echo $member->getFirstName() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_last_name">
  <?php echo $member->getLastName() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_email_address">
  <?php echo $member->getEmailAddress() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_username">
  <?php echo $member->getUsername() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_algorithm">
  <?php echo $member->getAlgorithm() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_salt">
  <?php echo $member->getSalt() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_password">
  <?php echo $member->getPassword() ?>
</td>
<td class="sf_admin_boolean sf_admin_list_td_is_active">
  <?php echo get_partial('profile/list_field_boolean', array('value' => $member->getIsActive())) ?>
</td>
<td class="sf_admin_boolean sf_admin_list_td_is_super_admin">
  <?php echo get_partial('profile/list_field_boolean', array('value' => $member->getIsSuperAdmin())) ?>
</td>
<td class="sf_admin_date sf_admin_list_td_last_login">
  <?php echo false !== strtotime($member->getLastLogin()) ? format_date($member->getLastLogin(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_text sf_admin_list_td_is_member">
  <?php echo $member->getIsMember() ?>
</td>
<td class="sf_admin_foreignkey sf_admin_list_td_member_type_id">
  <?php echo $member->getMemberTypeId() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_country">
  <?php echo $member->getCountry() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_timezone">
  <?php echo $member->getTimezone() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_culture">
  <?php echo $member->getCulture() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_middle_name">
  <?php echo $member->getMiddleName() ?>
</td>
<td class="sf_admin_date sf_admin_list_td_dob">
  <?php echo false !== strtotime($member->getDob()) ? format_date($member->getDob(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_text sf_admin_list_td_passport_no">
  <?php echo $member->getPassportNo() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_pan_no">
  <?php echo $member->getPanNo() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_occupation_type">
  <?php echo $member->getOccupationType() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_job_title">
  <?php echo $member->getJobTitle() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_industry">
  <?php echo $member->getIndustry() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_other_income_source">
  <?php echo $member->getOtherIncomeSource() ?>
</td>
<td class="sf_admin_boolean sf_admin_list_td_married">
  <?php echo get_partial('profile/list_field_boolean', array('value' => $member->getMarried())) ?>
</td>
<td class="sf_admin_enum sf_admin_list_td_gender">
  <?php echo $member->getGender() ?>
</td>
<td class="sf_admin_date sf_admin_list_td_marriage_anniversary">
  <?php echo false !== strtotime($member->getMarriageAnniversary()) ? format_date($member->getMarriageAnniversary(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_text sf_admin_list_td_year_as_nri">
  <?php echo $member->getYearAsNri() ?>
</td>
<td class="sf_admin_date sf_admin_list_td_created_at">
  <?php echo false !== strtotime($member->getCreatedAt()) ? format_date($member->getCreatedAt(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_date sf_admin_list_td_updated_at">
  <?php echo false !== strtotime($member->getUpdatedAt()) ? format_date($member->getUpdatedAt(), "f") : '&nbsp;' ?>
</td>
