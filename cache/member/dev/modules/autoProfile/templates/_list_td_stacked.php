<td colspan="30">
  <?php echo __('%%id%% - %%first_name%% - %%last_name%% - %%email_address%% - %%username%% - %%algorithm%% - %%salt%% - %%password%% - %%is_active%% - %%is_super_admin%% - %%last_login%% - %%is_member%% - %%member_type_id%% - %%country%% - %%timezone%% - %%culture%% - %%middle_name%% - %%dob%% - %%passport_no%% - %%pan_no%% - %%occupation_type%% - %%job_title%% - %%industry%% - %%other_income_source%% - %%married%% - %%gender%% - %%marriage_anniversary%% - %%year_as_nri%% - %%created_at%% - %%updated_at%%', array('%%id%%' => link_to($member->getId(), 'member_edit', $member), '%%first_name%%' => $member->getFirstName(), '%%last_name%%' => $member->getLastName(), '%%email_address%%' => $member->getEmailAddress(), '%%username%%' => $member->getUsername(), '%%algorithm%%' => $member->getAlgorithm(), '%%salt%%' => $member->getSalt(), '%%password%%' => $member->getPassword(), '%%is_active%%' => get_partial('profile/list_field_boolean', array('value' => $member->getIsActive())), '%%is_super_admin%%' => get_partial('profile/list_field_boolean', array('value' => $member->getIsSuperAdmin())), '%%last_login%%' => false !== strtotime($member->getLastLogin()) ? format_date($member->getLastLogin(), "f") : '&nbsp;', '%%is_member%%' => $member->getIsMember(), '%%member_type_id%%' => $member->getMemberTypeId(), '%%country%%' => $member->getCountry(), '%%timezone%%' => $member->getTimezone(), '%%culture%%' => $member->getCulture(), '%%middle_name%%' => $member->getMiddleName(), '%%dob%%' => false !== strtotime($member->getDob()) ? format_date($member->getDob(), "f") : '&nbsp;', '%%passport_no%%' => $member->getPassportNo(), '%%pan_no%%' => $member->getPanNo(), '%%occupation_type%%' => $member->getOccupationType(), '%%job_title%%' => $member->getJobTitle(), '%%industry%%' => $member->getIndustry(), '%%other_income_source%%' => $member->getOtherIncomeSource(), '%%married%%' => get_partial('profile/list_field_boolean', array('value' => $member->getMarried())), '%%gender%%' => $member->getGender(), '%%marriage_anniversary%%' => false !== strtotime($member->getMarriageAnniversary()) ? format_date($member->getMarriageAnniversary(), "f") : '&nbsp;', '%%year_as_nri%%' => $member->getYearAsNri(), '%%created_at%%' => false !== strtotime($member->getCreatedAt()) ? format_date($member->getCreatedAt(), "f") : '&nbsp;', '%%updated_at%%' => false !== strtotime($member->getUpdatedAt()) ? format_date($member->getUpdatedAt(), "f") : '&nbsp;'), 'messages') ?>
</td>
