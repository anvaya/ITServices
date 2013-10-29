<?php use_helper('I18N', 'Date') ?>
<?php include_partial('member/assets') ?>

<div id="sf_admin_container" class="sf_admin_edit ui-widget ui-widget-content ui-corner-all">
  <div class="fg-toolbar ui-widget-header ui-corner-all">
    <h1><?php echo __('Show Member "%%first_name%% %%last_name%%"', array('%%first_name%%' => $member->getFirstName(), '%%last_name%%' => $member->getLastName()), 'messages') ?></h1>
  </div>

  <?php include_partial('member/flashes') ?>

  <div id="sf_admin_header">&nbsp;</div>

  <div id="sf_admin_content">
    <div class="sf_admin_form">
      <div class="sf_admin_actions_block ui-widget">
        <ul class="sf_admin_actions_form">
            <?php echo $helper->linkToList(array(  'params' => 'class= fg-button ui-state-default fg-button-icon-left ',  'class_suffix' => 'list',  'label' => 'Back to list',  'ui-icon' => '',)) ?>
        </ul>
      </div>
      <div class="ui-helper-clearfix"></div>
      <div id="sf_fieldset_none" class="ui-corner-all" style="padding-top: 30px;">
        <div class="sf_admin_form_row sf_admin_text">
            <div class="label ui-helper-clearfix">
              <label>First Name:</label>
              <?php echo $member->getFirstName(); ?>
            </div>
        </div>
        <div class="sf_admin_form_row sf_admin_text">
            <div class="label ui-helper-clearfix">
              <label>Middle Name:</label>
              <?php echo $member->getMiddleName(); ?>
            </div>
        </div>
        <div class="sf_admin_form_row sf_admin_text">
            <div class="label ui-helper-clearfix">
              <label>Last Name:</label>
              <?php echo $member->getLastName(); ?>
            </div>
        </div>
        <div class="sf_admin_form_row sf_admin_text">
            <div class="label ui-helper-clearfix">
              <label>Email Address:</label>
              <?php echo $member->getEmailAddress(); ?>
            </div>
        </div>
        <div class="sf_admin_form_row sf_admin_text">
            <div class="label ui-helper-clearfix">
              <label>Date of Birth:</label>
              <?php echo $member->getDob(); ?>
            </div>
        </div>
        <div class="sf_admin_form_row sf_admin_text">
            <div class="label ui-helper-clearfix">
              <label>Country:</label>
              <?php echo $member->getCountry(); ?>
            </div>
        </div>
        <div class="sf_admin_form_row sf_admin_text">
            <div class="label ui-helper-clearfix">
              <label>Passport No.:</label>
              <?php echo $member->getPassportNo(); ?>
            </div>
        </div>
        <div class="sf_admin_form_row sf_admin_text">
            <div class="label ui-helper-clearfix">
              <label>Pancard No.:</label>
              <?php echo $member->getPanNo(); ?>
            </div>
        </div>
        <div class="sf_admin_form_row sf_admin_text">
            <div class="label ui-helper-clearfix">
              <label>Gender:</label>
              <?php echo $member->getGender() == "M" ? "Male" : "Female"; ?>
            </div>
        </div>
        <div class="sf_admin_form_row sf_admin_text">
            <div class="label ui-helper-clearfix">
              <label>Married:</label>
              <?php echo $member->getMarried() == 1 ? "Yes" : "No"; ?>
            </div>
        </div>
        <div class="sf_admin_form_row sf_admin_text">
            <div class="label ui-helper-clearfix">
              <label>Marriage Anniversary:</label>
              <?php echo $member->getMarriageAnniversary(); ?>
            </div>
        </div>
        <div class="sf_admin_form_row sf_admin_text">
            <div class="label ui-helper-clearfix">
              <label>Year as Nri:</label>
              <?php echo $member->getYearAsNri(); ?>
            </div>
        </div>
        <div class="sf_admin_form_row sf_admin_text">
            <div class="label ui-helper-clearfix">
              <label>Occupation type :</label>
              <?php echo $member->getOccupationType(); ?>
            </div>
        </div>
        <div class="sf_admin_form_row sf_admin_text">
            <div class="label ui-helper-clearfix">
              <label>Job title :</label>
              <?php echo $member->getJobTitle(); ?>
            </div>
        </div>
        <div class="sf_admin_form_row sf_admin_text">
            <div class="label ui-helper-clearfix">
              <label>Industry :</label>
              <?php echo $member->getIndustry(); ?>
            </div>
        </div>
        <div class="sf_admin_form_row sf_admin_text">
            <div class="label ui-helper-clearfix">
              <label> Other income source :</label>
              <?php echo $member->getOtherIncomeSource(); ?>
            </div>
        </div>
        <div class="sf_admin_form_row sf_admin_text">
            <div class="label ui-helper-clearfix">
              <label> Other income source :</label>
              <?php echo $member->getOtherIncomeSource(); ?>
            </div>
        </div>
        <div class="sf_admin_form_row sf_admin_text">
            <div class="label ui-helper-clearfix">
              <label> Timezone :</label>
              <?php echo $member->getTimezone(); ?>
            </div>
        </div>
        <div class="sf_admin_form_row sf_admin_text">
            <div class="label ui-helper-clearfix">
              <label> Culture :</label>
              <?php echo $member->getCulture(); ?>
            </div>
        </div>
      </div>
      <div class="sf_admin_actions_block ui-widget ui-helper-clearfix">
        <ul class="sf_admin_actions_form">
            <?php echo $helper->linkToList(array(  'params' => 'class= fg-button ui-state-default fg-button-icon-left ',  'class_suffix' => 'list',  'label' => 'Back to list',  'ui-icon' => '',)) ?>
        </ul>
      </div>
    </div>
  </div>

  <div id="sf_admin_footer">&nbsp;</div>

  <?php include_partial('member/themeswitcher') ?>
</div>
