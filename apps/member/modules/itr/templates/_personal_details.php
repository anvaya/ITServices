<?php

    /* @var $form itr_submissionForm */
    $record = $form->getObject();
    /* @var $record itr_submission */
    
    function error_row_class($field_name, $form)
    {
        //if(!isset($form[$field_name])) return "";
        
        if(is_array($field_name))
        {
            foreach($field_name as $fld)
            {
                if($form[$fld]->hasError())
                {
                    return "ui-corner-all row_error";
                }
            }
        }
        else
        {
            if($form[$field_name]->hasError())
            {
                return "ui-corner-all row_error";
            }
        }
        return "";
    }
    
    $states["1"]="Andaman &amp; Nicobar Islands";
    $states["2"]="Andhra Pradesh";
    $states["3"]="Arunachal Pradesh";
    $states["4"]="Assam";
    $states["5"]="Bihar";
    $states["6"]="Chandigarh";
    $states["33"]="Chhattisgarh";
    $states["7"]="Dadra &amp; Nagar Haveli";
    $states["8"]="Daman &amp; Diu";
    $states["9"]="Delhi";
    $states["10"]="Goa";
    $states["11"]="Gujarat";
    $states["12"]="Haryana";
    $states["13"]="Himachal Pradesh";
    $states["14"]="Jammu &amp; Kashmir";
    $states["35"]="Jharkhand";
    $states["15"]="Karnataka";
    $states["16"]="Kerala";
    $states["17"]="Lakhswadeep";
    $states["18"]="Madhya Pradesh";
    $states["19"]="Maharashtra";
    $states["20"]="Manipur";
    $states["21"]="Meghalaya";
    $states["22"]="Mizoram";
    $states["23"]="Nagaland";
    $states["24"]="Orissa";
    $states["25"]="Pondicherry";
    $states["26"]="Punjab";
    $states["27"]="Rajasthan";
    $states["28"]="Sikkim";
    $states["29"]="Tamil Nadu";
    $states["30"]="Tripura";
    $states["31"]="Uttar Pradesh";
    $states["32"]="West Bengal";
    $states["34"]="Uttaranchal"; 
?>
<div id="page1" data-bind="visible: currentPage() == 1">
    <div style="padding: 5px; border: 1px solid green; width: 80%;">
            <h2>Please note: Fields marked with (<span class="required">*</span>) are mandatory.</h2>    
        </div>   
    
    <fieldset id="personal_details">
        <legend>Personal Details</legend>
        <div class="form_row <?php echo error_row_class(array("first_name","middle_name","last_name"),$form); ?>" >
            <label for="full_name">Full Name<span class='required'>*</span></label>
            <div class="content">
                <table id="full_name">
                    <tr>
                        <td>
                            <?php echo $form['first_name']->render(array("placeholder"=>"First Name"));?>
                            <?php if($form['first_name']->hasError()):?>
                                <?php echo $form['first_name']->renderError();?>
                            <?php endif;?>
                        </td>
                        <td>
                            <?php echo $form['middle_name']->render(array("placeholder"=>"Middle Name"));?>
                            <?php if($form['middle_name']->hasError()):?>
                                <?php echo $form['middle_name']->renderError();?>
                            <?php endif;?>
                        </td>
                        <td>
                            <?php echo $form['last_name']->render(array("placeholder"=>"Last Name"));?>
                            <?php if($form['last_name']->hasError()):?>
                                <?php echo $form['last_name']->renderError();?>
                            <?php endif;?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>             
        
        <div class="form_row <?php echo error_row_class("dob",$form); ?>">
            <label for="itr_submission_dob">Date of Birth<span class='required'>*</span></label>
            <div class="content">
                <?php echo $form['dob']->render(array("placeholder"=>"Date of Birth"));?>
                <?php if($form['dob']->hasError()):?>
                    <?php echo $form['dob']->renderError();?>
                <?php endif;?>
            </div>
        </div>
        
        <div class="form_row <?php echo error_row_class("gender",$form); ?>">
            <label for="itr_submission_gender">Gender<span class='required'>*</span></label>
            <div class="content">
                <?php echo $form['gender']->render(array("placeholder"=>"Gender"));?>
                <?php if($form['gender']->hasError()):?>
                    <?php echo $form['gender']->renderError();?>
                <?php endif;?>
            </div>
        </div>
        
        <div class="form_row <?php echo error_row_class("pan_no",$form); ?>">
            <label for="itr_submission_pan_no">PAN Card No.<span class='required'>*</span></label>
            <div class="content">
                <?php echo $form['pan_no']->render(array("placeholder"=>"PAN Card No","title"=>"Your PAN Card Number"));?>
                <?php if($form['pan_no']->hasError()):?>
                    <?php echo $form['pan_no']->renderError();?>
                <?php endif;?>
            </div>
        </div>
        
        <div class="form_row <?php echo error_row_class("email_address",$form); ?>">
            <label for="itr_submission_email_address">Email Address<span class='required'>*</span></label>
            <div class="content">
                <?php echo $form['email_address']->render(array("placeholder"=>"Email Address"));?>
                <?php if($form['email_address']->hasError()):?>
                    <?php echo $form['email_address']->renderError();?>
                <?php endif;?>
            </div>
        </div>
        
        <div class="form_row <?php echo error_row_class("phone_no",$form); ?>">
            <label for="itr_submission_phone_no">Phone No.<span class='required'>*</span></label>
            <div class="content">
                <?php echo $form['phone_no']->render(array("placeholder"=>"Phone No"));?>
                <?php if($form['phone_no']->hasError()):?>
                    <?php echo $form['phone_no']->renderError();?>
                <?php endif;?>
            </div>
        </div>
        
        <div class="form_row <?php echo error_row_class("fathers_name",$form); ?>">
            <label for="itr_submission_fathers_name">Father's Name<span class='required'>*</span></label>
            <div class="content">
                <?php echo $form['fathers_name']->render(array("placeholder"=>"Father's Full Name","title"=>"Fathers full name:First Middle Last"));?>
                <?php if($form['fathers_name']->hasError()):?>
                    <?php echo $form['fathers_name']->renderError();?>
                <?php endif;?>
            </div>
        </div>
        
        <div class="form_row <?php echo error_row_class("mothers_name",$form); ?>">
            <label for="itr_submission_mothers_name">Mother's Name</label>
            <div class="content">
                <?php echo $form['mothers_name']->render(array("placeholder"=>"Mother's Full Name", "title"=>"Mother's Last Name: First Middle Last"));?>
                <?php if($form['mothers_name']->hasError()):?>
                    <?php echo $form['mothers_name']->renderError();?>
                <?php endif;?>
            </div>
        </div>       
    </fieldset>
    
    <fieldset id="address">
        <legend>Address (For correspondence in India)</legend>
        <div class="form_row <?php echo error_row_class("flat_no",$form); ?>">
            <label for="itr_submission_flat_no">Flat/Door/Block No.</label>
            <div class="content">
                <?php echo $form['flat_no']->render(array("placeholder"=>"Flat/Door/Block No."));?>
                <?php if($form['flat_no']->hasError()):?>
                    <?php echo $form['flat_no']->renderError();?>
                <?php endif;?>
            </div>
        </div>
        
        <div class="form_row <?php echo error_row_class("premises",$form); ?>">
            <label for="itr_submission_premises">Name of Building Premises</label>
            <div class="content">
                <?php echo $form['premises']->render(array("placeholder"=>"Building Premises"));?>
                <?php if($form['premises']->hasError()):?>
                    <?php echo $form['premises']->renderError();?>
                <?php endif;?>                
            </div>
        </div>
        
        <div class="form_row <?php echo error_row_class("street",$form); ?>">
            <label for="itr_submission_street">Road/ Street/ Post Office</label>
            <div class="content">
                <?php echo $form['street']->render(array("placeholder"=>"Road/Street/Post Office"));?>
                <?php if($form['street']->hasError()):?>
                    <?php echo $form['street']->renderError();?>
                <?php endif;?>
            </div>
        </div>
        
        <div class="form_row <?php echo error_row_class("area",$form); ?>">
            <label for="itr_submission_area">Area/Locality</label>
            <div class="content">
                <?php echo $form['area']->render(array("placeholder"=>"Area"));?>
                <?php if($form['area']->hasError()):?>
                    <?php echo $form['area']->renderError();?>
                <?php endif;?>
            </div>
        </div>

        <div class="form_row <?php echo error_row_class("city",$form); ?>">
            <label for="itr_submission_city">Town/City/District</label>
            <div class="content">
                <?php echo $form['city']->render(array("placeholder"=>"Town/City/District"));?>
                <?php if($form['city']->hasError()):?>
                    <?php echo $form['city']->renderError();?>
                <?php endif;?>
            </div>
        </div>
        
        <div class="form_row <?php echo error_row_class("state",$form); ?>">
            <label for="itr_submission_state">State</label>
            <div class="content">
                <?php echo $form['state']->render(array("placeholder"=>"State"));?>
                <?php if($form['state']->hasError()):?>
                    <?php echo $form['state']->renderError();?>
                <?php endif;?>
            </div>
        </div>
        
        <div class="form_row <?php echo error_row_class("country",$form); ?>">
            <label for="itr_submission_country">Country</label>
            <div class="content">
                <?php echo $form['country']->render(array("placeholder"=>"country"));?>
                <?php if($form['country']->hasError()):?>
                    <?php echo $form['country']->renderError();?>
                <?php endif;?>                
            </div>
        </div>
        
        <div class="form_row <?php echo error_row_class("pin",$form); ?>">
            <label for="itr_submission_pin">PIN Code</label>
            <div class="content">
                <?php echo $form['pin']->render(array("placeholder"=>"Pin Code"));?>
                <?php if($form['pin']->hasError()):?>
                    <?php echo $form['pin']->renderError();?>
                <?php endif;?>                
            </div>
        </div>
        
    </fieldset>
    
    <fieldset id="bank">
        <legend title="Account in your name, either Savings/NRO">NRO Bank A/c Details (For credit of income tax refunds)</legend>
        <div class="form_row <?php echo error_row_class("bank_ac_no",$form); ?>">
            <label for="itr_submission_bank_ac_no">Bank account No.<span class='required'>*</span></label>
            <div class="content">
                <?php echo $form['bank_ac_no']->render(array("placeholder"=>"Bank A/c No.","class"=>"required"));?>
                <?php if($form['bank_ac_no']->hasError()):?>
                    <?php echo $form['bank_ac_no']->renderError();?>
                <?php endif;?>                                
                <span class="help_icon" help_id="bank_ac"></span>
            </div>            
        </div>
        
        <div class="form_row <?php echo error_row_class("ac_type",$form); ?>" style="display: none;">
            <label for="itr_submission_ac_type">Type of account<span class='required'>*</span></label>            
            <div class="content">
                <?php echo $form['ac_type']->render(array("class"=>"required"));?>
                <?php if($form['ac_type']->hasError()):?>
                    <?php echo $form['ac_type']->renderError();?>
                <?php endif;?>                                
            </div>
        </div>
        
        <div class="form_row <?php echo error_row_class("ifsc_code",$form); ?>">
            <label for="ifsc_code">IFSC Code<span class='required'>*</span></label>
            <div class="content">
                <?php echo $form['ifsc_code']->render(array("class"=>"required","title"=>"IFSC Code is required for refunds to your bank account. You can find it on your bank cheque book."));?>
                <a href="http://bankifsccode.com/" target="_blank">Find IFSC Code</a>
                <?php if($form['ifsc_code']->hasError()):?>
                    <?php echo $form['ifsc_code']->renderError();?>
                <?php endif;?>                                
                <span class="help_icon" help_id="ifsc_micr" ></span>
            </div>
        </div>
        
         <div class="form_row <?php echo error_row_class("micr_code",$form); ?>">
            <label for="ifsc_code">Micr Code<span class='required'>*</span></label>
            <div class="content">
                <?php echo $form['micr_code']->render(array("class"=>"required","title"=>"MICR Code is required for refunds to your bank account. You can find it on your bank cheque book."));?>
                <a href="http://bankifsccode.com/" target="_blank">Find MICR Code</a>
                <?php if($form['micr_code']->hasError()):?>
                    <?php echo $form['ifsc_code']->renderError();?>
                <?php endif;?>                                
                <span class="help_icon" help_id="ifsc_micr" ></span>
            </div>
        </div>
    </fieldset>
    
</div>

