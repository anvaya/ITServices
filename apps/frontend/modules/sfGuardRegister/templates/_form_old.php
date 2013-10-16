<?php include_stylesheets_for_form($form) ?>
<?php include_javascripts_for_form($form) ?>
<?php
        $fieldsets = array
        (             
             "Login Information"=>array("username", 'email_address', 'password','password_again'),
             "Personal Information"=>array('first_name','middle_name','last_name','dob','married','gender'),
             "Current Address "=>array("country","nri_address"),
             "Address in India"=>array("in_address"),
             "Contact Information"=>array("nri_mobile","nri_landline","nri_office","nri_fax"),
             "Contact Information (India)"=>array("in_mobile","in_landline"),
             "Occupation"=>array("occupation_type","job_title","industry","other_income_source"),
             "Indentification and Taxation"=>array("passport_no","pan_no")
             
        )
?>
<form action="<?php echo url_for('@sf_guard_register') ?>" method="post">
  <table class="sf_admin_row"><tbody>
    <tr><td>
    <?php foreach($fieldsets as $fieldset=>$fields):?>  
      <fieldset   id="sf_fieldset_<?php echo preg_replace('/[^a-z0-9_]/', '_', strtolower($fieldset)) ?>">
          <h2><?php echo $fieldset ?></h2>
          <?php foreach ($fields as $name): ?>
          <?php if ((isset($form[$name]) && $form[$name]->isHidden()) || (!isset($form[$name]) )) continue ?>
            <div class="sf_admin_row">
                <?php echo $form[$name]->renderLabel();?>
                <div class="content">
                    <?php echo $form[$name]->render();?>
                </div>
            </div>
        <?php endforeach; ?>
      </fieldset>   
    <?php endforeach;?>   
            
    </td></tr>
  </tbody>
    <tfoot>
      <tr>
        <td colspan="2">
          <input type="submit" name="register" value="<?php echo __('Register', null, 'sf_guard') ?>" />
        </td>
      </tr>
    </tfoot>
  </table>
</form>