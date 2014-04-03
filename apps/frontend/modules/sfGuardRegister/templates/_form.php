<?php include_stylesheets_for_form($form) ?>
<?php include_javascripts_for_form($form) ?>
<?php
        $fieldsets = array
        (             
             "Login Information"=>array("username", 'email_address', 'password','password_again'),
             "Personal Information"=>array('first_name','middle_name','last_name','dob','married','gender'),
             "Current Address (Outside India) "=>array("country","nri_address"),
             "Address in India"=>array("in_address"),
             "Contact Information"=>array("nri_mobile","nri_landline"/*,"nri_office","nri_fax"*/),
             "Contact Information (India)"=>array("in_mobile","in_landline"),             
             /*"Occupation"=>array("occupation_type","job_title","industry","other_income_source"),
             "Indentification and Taxation"=>array("pan_no")*/
             
        )
?>
<?php  if ($form->hasErrors()): ?>
    <div class="error_message ui-corner-all" >
        Oops, we found some errors in the data you submitted. Please check and submit again.    
    </div>    
    <?php /*foreach($form->getWidgetSchema()->getPositions() as $widgetName): ?>
        <?php if($form[$widgetName]->hasError()): ?>
        <p><?php echo $form[$widgetName]->renderLabelName().': '.$form[$widgetName]->getError()->getMessageFormat(); ?></p>
        <?php endif; ?>
    <?php endforeach;*/ ?>
<?php endif; ?>
<?php echo $form->renderGlobalErrors()  ?> 
<form action="<?php echo url_for('@sf_guard_register') ?>" method="post">
  <table class="sf_admin_row"><tbody>
    <tr><td>
    <?php foreach($fieldsets as $fieldset=>$fields):?>  
      <fieldset   id="sf_fieldset_<?php echo preg_replace('/[^a-z0-9_]/', '_', strtolower($fieldset)) ?>">
          <h2><?php echo $fieldset ?></h2>
          <?php foreach ($fields as $name): ?>
          <?php if ((isset($form[$name]) && $form[$name]->isHidden()) || (!isset($form[$name]) )) continue ?>
            <div class="sf_admin_row">
                <?php echo $form[$name]->renderError(); ?>
                <div>
                  <?php echo $form[$name]->renderLabel();?>
                  <div class="content">
                      <?php echo $form[$name]->render();?>
                  </div>
                </div>
            </div>
        <?php endforeach; ?>
      </fieldset>   
    <?php endforeach;?>   
    
    <?php $fieldset = "Subscription";?>        
    <?php 
            $subscriptions = subscriptionTable::getInstance()
                                ->getActiveSubscriptions();
    ?>        
            <fieldset  id="sf_fieldset_<?php echo preg_replace('/[^a-z0-9_]/', '_', strtolower($fieldset)) ?>" style="display: none;">
          <h2><?php echo $fieldset ?></h2>
          
          
        <div class="sf_admin_row">
           <?php echo $form['subscription']->renderError(); ?>
           <div>             
             <div class="content" >
                 <table id="subscriptions" cellspacing="0">
                     <thead>
                         <tr>
                             <th align="left">Title</th>
                             <th>Features</th>
                             <th>Price</th>
                         </tr>
                     </thead>
                     <tbody>
                         <?php foreach($subscriptions as $index=>$subscription): /* @var $subscription subscription */?>
                         <tr>
                             <td>
                                 <input type="radio" <?php if($index==0):?>checked<?php endif;?>  name="sf_guard_user[subscription][subscription_id]" id="user_subscription_subscription_id_<?php echo $subscription->getId() ?>" value="<?php echo $subscription->getId() ?>" />
                                 <label for="user_subscription_subscription_id_<?php echo $subscription->getId() ?>"><?php echo $subscription->getName();?></label>
                             </td>
                             <td>
                                 <ul class="product_list">
                                    <?php 
                                          $products = $subscription->getSubscriptionProduct();
                                          foreach($products as $product): /* @var $product product*/
                                    ?>
                                     <li>
                                         <?php echo $product->getProduct()->getName();?>
                                     </li>
                                     <?php endforeach;?>                                     
                                 </ul>
                             </td>
                             <td><?php echo $subscription->getCurrency()." ".$subscription->getPrice(); ?></td>
                         </tr>
                         <?php endforeach;?>
                     </tbody>                         
                 </table>
             </div>
           </div>
       </div>
        
    </fieldset>               
            
    <?php $fieldset = "Special Benefit";?>        
    <?php 
            $subscriptions = subscriptionTable::getInstance()
                                ->getActiveSubscriptions();
    ?>        
          <fieldset  id="sf_fieldset_<?php echo preg_replace('/[^a-z0-9_]/', '_', strtolower($fieldset)) ?>">
            <h2><?php echo $fieldset ?></h2>            
            <label style="padding-bottom: 5px;">Received a special benefit coupon from Groworth ? Please enter it here.</label>
            <div class="sf_admin_row">
                <div>
                    <?php echo $form['subscription']['coupon_code']->renderError(); ?>                
                    <label for="sf_guard_user_subscription_coupon_code">Enter Coupon Code  </label>
                    <div class="content">
                        <?php echo $form['subscription']['coupon_code'];?>
                    </div>
                </div>
            </div>
          </fieldset>              
    </td></tr>
  </tbody>
    <tfoot>
      <tr>
        <td colspan="2" style="text-align: center">
          <?php echo $form->renderHiddenFields(); ?>
          <input type="submit" class="purple-btn" name="register" value="<?php echo __('Register', null, 'sf_guard') ?>" /><br />
        </td>
      </tr>
    </tfoot>
  </table>
</form>
<script type="text/javascript" language="javascript">
$( document ).ready(function() {
  $('#sf_guard_user_nri_mobile_isd_code').on('change', function() {
    //alert( this.value ); // or $(this).val()
    $('#sf_guard_user_nri_landline_isd_code').val(this.value);
    $('#sf_guard_user_nri_office_isd_code').val(this.value);
    $('#sf_guard_user_nri_fax_isd_code').val(this.value);
  });
  
  $('#sf_guard_user_nri_address_country').on('change', function() {
    //alert( this.value ); // or $(this).val()
    $('#sf_guard_user_nri_mobile_country').val(this.value);
    $('#sf_guard_user_nri_landline_country').val(this.value);
    $('#sf_guard_user_nri_office_country').val(this.value);
    $('#sf_guard_user_nri_fax_isd_country').val(this.value);
  });
  
});
</script>