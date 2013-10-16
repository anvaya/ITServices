<?php use_helper('I18N') ?>
<?php 

$tab_labels = array
  (
    "Country"=>"Country",
    "Your_Information"=>"Your Information",
    "Current_Address"=>"Current Address",
    "Permanent_Address"=>"Permanent Address",
    "Your_Role"=>"Your Role",
    "Emergency_Contact"=>"Emergency Contact Information",
    "Additional_Informati"=>"Additional Information",
    "Primary_Parent/Guard"=>"Primary Parent/Guardian",
    "Additional_Parent/Gu"=>"Additional Parent/Guardian Information"
  );


?>
<?php /* if ($form->hasErrors()): ?>
    <p>The form has some errors you need to fix.</p>
    <?php foreach($form->getWidgetSchema()->getPositions() as $widgetName): ?>
        <?php if($form[$widgetName]->hasError()): ?>
        <p><?php echo $form[$widgetName]->renderLabelName().': '.$form[$widgetName]->getError()->getMessageFormat(); ?></p>
        <?php endif; ?>
    <?php endforeach; ?>
<?php endif; ?>
<?php echo $form->renderGlobalErrors()  ?> 
<?php if ($sub_form->hasErrors()): ?>
    <p>The sub_form has some errors you need to fix.</p>
    <?php foreach($sub_form->getWidgetSchema()->getPositions() as $widgetName): ?>
        <?php if($sub_form[$widgetName]->hasError()): ?>
        <p><?php echo $sub_form[$widgetName]->renderLabelName().': '.$sub_form[$widgetName]->getError()->getMessageFormat(); ?></p>
        <?php endif; ?>
    <?php endforeach; ?>
<?php endif; ?>
<?php echo $sub_form->renderGlobalErrors(); */ ?> 
<div style="clear:both;"></div>
  
<form action="<?php echo url_for('@sf_guard_register') ?>" method="post" onsubmit="return validateForm()" >
    <div id="tabs">
        <ul style="display:none;">
          <li><a href="#tabs-1">Page 1</a></li>
          <li><a href="#tabs-2">Page 2</a></li>
          <li><a href="#tabs-3">Page 3</a></li>
          <li><a href="#tabs-4">Page 4</a></li>
          <li><a href="#tabs-5">Page 5</a></li>
        </ul>
  
        <div id="tabs-1">
          <fieldset id="sf_fieldset_none">
            
            <?php foreach($form as $key => $field ):?>
              <?php if($field->isHidden()) continue; ?>
                <div class="sf_admin_form_row sf_admin_text">
                    <?php echo $field->renderError(); ?>
                    <div>
                        <?php echo $field->renderLabel(); ?>
                        <div class="content">
                            <?php echo $field->render(); ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <div class="sf_admin_form_row sf_admin_text">
              <label>&nbsp;</label>
              <div class="content">
                <?php echo $form->renderHiddenFields(); ?>
                <a class="open-tab" href="#tabs-2">Next</a>
                </div>
            </div>
          </fieldset>
        </div>
      
        <?php $tab_page = ""; $group = ""; $i =2; $field_name = ""; ?>
        <?php $last_field = count ($sub_form);$j = 1; ?>
        <?php foreach($sub_form as $key => $field ):?>
          <?php
            // pass for hidden field and program year id
            if($field->isHidden() || $key == "program_year_id" || $key == "captcha") continue;
          ?>
          <?php
            // explode field name for get group_code,question_id and answer_type
            $arr_q_id = explode("_",$key);
            /* @var $form_question form_question */
            $form_question = Doctrine_Core::getTable('form_question')->find($arr_q_id[1]);
            $page_num = $form_question->getPageNum();
            //if($page_num == 4)
            //{
            //  break;
           // }
            $gc = $form_question->getGroupCode();
            if($j == 1 )
              $group = $gc;
          ?>
          <?php if($tab_page != $page_num): ?>
            <?php if($j > 1): ?>
                <?php $i++; ?>
                <div class="sf_admin_form_row sf_admin_text">
                  <label>&nbsp;</label>
                  <div class="content">
                    <a class="open-tab" href="#tabs-<?php echo $i-2; ?>">Back</a>
                    <a class="open-tab" href="#tabs-<?php echo $i ?>">Next</a>
                  </div>
                </div>
                </fieldset>
            </div>
            <?php endif; ?>      
            <div id="tabs-<?php echo $i; ?>">
                <fieldset id="sf_fieldset_none">
          <?php endif; ?>      
                <?php if($group != $gc || $j == 1): ?>
                    <?php if(stristr($gc, "nogroup") === FALSE): ?>
                      <div class="sf_admin_form_row sf_admin_text tab_head">
                        <?php echo strtoupper($tab_labels[$gc]); ?>
                      </div>
                    <?php endif; ?>
                    <?php if($gc == "Nogroup_2"): ?>
                      <div class="sf_admin_form_row" style="border:none;">
                        The following selections are based on the federal government guidelines for race and ethnicity. Please select the option that best describes you.
                      </div>
                    <?php endif; ?>
                <?php endif; ?>
                <?php
                  if($form_question->getCssClass() != "")
                    $field_css_class = $form_question->getCssClass();
                  else
                    $field_css_class = "";
                  
                  if($form_question->getAnswerType() == question_bankTable::ANSWER_TYPE_MULTI_CHOICE_WITH_TEXT || $form_question->getAnswerType() == question_bankTable::ANSWER_TYPE_SINGLE_CHOICE_WITH_TEXT)
                    $css_style = 'style="border:0;"';
                  else 
                    $css_style = '';
                ?>
                <div class="sf_admin_form_row sf_admin_text <?php echo $field_css_class ?>" <?php echo $css_style ?>>
                    <?php echo $field->renderError(); ?>
                    <div>
                        <?php echo $field->renderLabel(); ?>
                        <div class="content">
                            <?php echo $field->render(); ?>
                        </div>
                    </div>
                </div>
          <?php $tab_page = $page_num; ?>
          <?php $group = $gc; ?>
          <? $j++; ?>
        <?php endforeach;?>
        <?php echo include_partial('agree',array('i'=>$i,'sub_form'=>$sub_form)); ?>
    </div>
    <?php //echo $sub_form['_csrf_token'] ?>
    <?php //echo $sub_form[$sub_form->getCSRFFieldName()]->render() ?>
  <?php echo $sub_form->renderHiddenFields(); ?>
</form>

<script type="text/javascript">
    
    function validateForm()
    {
        var tab_valid = true;
        var active = $("#tabs").tabs("option", "active") + 1;

        pp_div = $('#tabs-' + active);
        $('.error_list', pp_div).remove();
        
        $('input.required', '#tabs-' + active ).each(function()
        {
          var err = "";
          var name, value;          
          if($(this).attr('type')=="hidden") return;
          name = $(this).attr('name');
          if($(this).attr('type') != 'text' && $(this).attr('type') != 'textarea')
          {
             value = $('input[name="' + name + '"]:checked').val();
             if(value==undefined) value="";
             err = errormsg($(this).attr('id'),$(this).attr('type'))
          }
          else
          {
             value = $(this).val();    
          }

          if($.trim(value) == "")
          {
            //var id = $(this).attr('id');
            var pp_div = $(this).parent().parent().parent();
            $(pp_div).children('.error_list').remove();

            var p_div = $(this).closest('div'); //parent('div'); //.parent();
            var already_added = $('.error_list', p_div.parent());

            if(!already_added.length)
            {
                $('<ul class="error_list"><li>'+err+'</li></ul>').insertBefore(p_div);
            }

            //$(id).focus();
            tab_valid = false;              
          } 
        });
        if(!tab_valid)
          return false;
    }
    
    function errormsg(field_id,field_type)
    {
          var err = "";
          var _attr = $('#'+field_id).attr('error_msg');
          if(typeof _attr !== "undefined" && _attr !== false && _attr !== null){
            err = $('#'+field_id).attr('error_msg');
          }
          if(err == "")
          {
            err = "You must provide an answer";
            /* if(field_type == 'select'){
                var pp_div = $("#"+field_id).parent().parent().parent();
                var label = $(pp_div).children().eq(0).find('label');
                err = label.html();
                err = err.replace('<span class="mandatory">* </span>','');
                err = err + " Field cannot left blank.";
            }
            else if(field_type == 'password'){
              var label = $('label[for="'+field_id+'"]');
              err = jQuery(label).html();
              err = err.replace('<span class="mandatory">* </span>','');
              err =  err + " Field cannot left blank."; 
            }
            else if(field_type != 'text' && field_type != 'textarea')
            {
              var label_div = $("#"+field_id).parent().parent().parent().parent().parent();
              var label = $(label_div).children().eq(0).find('label');
              err = jQuery(label).html();
              err = err.replace('<span class="mandatory">* </span>','')
              err =  err + " Field cannot left blank."; 
            }
            else
            {
              var label = $('label[for="'+field_id+'"]');
              err = jQuery(label).html();
              err = err.replace('<span class="mandatory">* </span>','');
              err =  err + " Field cannot left blank."; 
            } */
          }
          
          return err;
    }

    $(document).ready(function(){
      
        //your role hide radio button list
        jQuery("#subform_yourrole_35_9_selectedoptions_1").parent().parent().parent().parent().parent().hide();
        jQuery("#subform_yourrole_35_9_answertext").parent().parent().parent().hide();
        jQuery("#subform_yourrole_35_9_answertext").attr('disabled', 'disabled');
      
        var tabs = $('#tabs').tabs();        
        
        $('.open-tab').click(function (event) 
        {
          jQuery("#academic_year").html(jQuery("#subform_program_year_id option:selected").text());
          var tab_valid = true;
          
          if($(this).text() != "Back")
          {
            var active = $("#tabs").tabs("option", "active") + 1;
            
            pp_div = $('#tabs-' + active);
            $('.error_list', pp_div).remove();

            $('input.required', '#tabs-' + active ).each(function()
            {
               var name, value;          
               
               if($(this).attr('type')=="hidden") return;
               
               name = $(this).attr('name');
               
               var chk = chkfieldname(name,this.id,$(this).val());
               if($(this).attr('type') == 'password')
               {
                   var pp_div = $(this).parent().parent().parent();
                   $(pp_div).children('.error_list').remove();
                   var p_div = $(this).closest('div');
                   value = $.trim($(this).val());
                   if(value == "")
                   {
                        $('<ul class="error_list"><li>Password field cannot left blank.</li></ul>').insertBefore(p_div);
                        tab_valid = false;
                   }
                   else if(name == "sf_guard_user[password_again]" && value != $("#sf_guard_user_password").val() && value != "")
                   {
                        $('<ul class="error_list"><li>Password and Password again missmatch.</li></ul>').insertBefore(p_div);
                        tab_valid = false;
                   }
               }
               else if($(this).attr('type') != 'text' && $(this).attr('type') != 'textarea')
               {
                   value = $('input[name="' + name + '"]:checked').val();
                   if(value==undefined) value="";
                    var err = errormsg($(this).attr('id'),$(this).attr('type'))
               }
               else
               {
                  value = $(this).val();
                  var err = errormsg($(this).attr('id'),$(this).attr('type'))
               }

               if($.trim(value) == "" && chk)
               {
                //var id = $(this).attr('id');
                var pp_div = $(this).parent().parent().parent();
                $(pp_div).children('.error_list').remove();

                var p_div = $(this).closest('div'); //parent('div'); //.parent();
                var already_added = $('.error_list', p_div.parent());
                if(!already_added.length)
                {
                    $('<ul class="error_list"><li>'+err+'</li></ul>').insertBefore(p_div);
                }
                
                //$(id).focus();
                tab_valid = false;              
               } 
            });
            
            $('select.required', '#tabs-' + active ).each(function()
            {
               var name, value;          
               
               value = $(this).val();                  

               if($.trim(value) == "")
               {
                //var id = $(this).attr('id');
                var pp_div = $(this).parent().parent().parent();
                $(pp_div).children('.error_list').remove();

                var p_div = $(this).closest('div'); //parent('div'); //.parent();
                var already_added = $('.error_list', p_div.parent());
                
                if(!already_added.length)
                {
                    var err = errormsg($(this).attr('id'),'select')
                    $('<ul class="error_list"><li>' +err+ '</li></ul>').insertBefore(p_div);
                }
                
                //$(id).focus();
                tab_valid = false;              
               } 
            });
          }
          
          var tab = $(this).attr('href');
          var arr_idx = tab.split("-");
          idx = parseInt(arr_idx[1]) - 1;                    
          
          if(tab_valid)
          {
            tabs.tabs("option", "active", idx);
            var active = $("#tabs").tabs("option", "active") + 1;
            pp_div = $('#tabs-' + active);
            $('.error_list', pp_div).remove();// .children('.error_list').remove();
          }
        });            
        
        //permanent address is same as current address
        $("#subform_permanentaddress_22_7_1").click(function()
        {
          if($(this).is(":checked"))
          {
            $("#subform_permanentaddress_23_1").val($("#subform_currentaddress_16_1").val());
            $("#subform_permanentaddress_24_1").val($("#subform_currentaddress_17_1").val());
            $("#subform_permanentaddress_25_1").val($("#subform_currentaddress_18_1").val());
            $("#subform_permanentaddress_26_1").val($("#subform_currentaddress_19_1").val());
            $("#subform_permanentaddress_27_1").val($("#subform_currentaddress_20_1").val());
            $("#subform_permanentaddress_28_4").val($("#subform_currentaddress_21_4").val());
          }else{
            $("#subform_permanentaddress_23_1").val("");
            $("#subform_permanentaddress_24_1").val("");
            $("#subform_permanentaddress_25_1").val("");
            $("#subform_permanentaddress_26_1").val("");
            $("#subform_permanentaddress_27_1").val("");
            $("#subform_permanentaddress_28_4").val("");
          }
        });

        // your role check uncheck radio button
        var count_radio = 0;
        $("input:radio[name='subform[yourrole_34_6]']").each(function(){
          count_radio++;
        });
        
        for(var cr = 1; cr <= count_radio; cr++)
        {
          $("#subform_yourrole_34_6_"+cr).click(function()
          {
            if($(this).attr('checked','checked') && this.id == "subform_yourrole_34_6_1")
            {
              jQuery("#subform_yourrole_35_9_selectedoptions_1").parent().parent().parent().parent().parent().show();
              jQuery("#subform_yourrole_35_9_answertext").parent().parent().parent().show();
            }else
            {
              jQuery("#subform_yourrole_35_9_selectedoptions_1").parent().parent().parent().parent().parent().hide();
              jQuery("#subform_yourrole_35_9_answertext").parent().parent().parent().hide();
            }
          });
        }
        
        var count_radio = 0;
        $("input:radio[name='subform[yourrole_35_9_selectedoptions]']").each(function(){
          count_radio++;
        });
        for(var cr = 1; cr <= count_radio; cr++)
        {
          $("#subform_yourrole_35_9_selectedoptions_"+cr).click(function()
          {
            if($(this).attr('checked','checked') && this.id == "subform_yourrole_35_9_selectedoptions_7")
            {
              $('#subform_yourrole_35_9_answertext').val("");
              $('#subform_yourrole_35_9_answertext').removeAttr('disabled');
            }else
            {
              $('#subform_yourrole_35_9_answertext').attr('disabled', 'disabled');
            }
          });
        }

    });
    
    function chkfieldname(field_name,field_id,field_value)
    {
      if(field_id == "subform_yourinformation_10_1" && jQuery.trim(field_value) == "" && $("#subform_yourinformation_11_7_1").is(":checked"))
      {
        var pp_div = $("#"+field_id).parent().parent().parent();
        $(pp_div).children('.error_list').remove();
        return false;
      }
      if(field_id == "subform_yourinformation_12_1" && jQuery.trim(field_value) == "" && $("#subform_yourinformation_13_7_1").is(":checked"))
      {
        var pp_div = $("#"+field_id).parent().parent().parent();
        $(pp_div).children('.error_list').remove();
        return false;
      }
      if(field_id == "subform_yourinformation_14_1" && jQuery.trim(field_value) == "" && $("#subform_yourinformation_15_7_1").is(":checked"))
      {
        var pp_div = $("#"+field_id).parent().parent().parent();
        $(pp_div).children('.error_list').remove();
        return false;
      }
      
      
      var field_val = "";
      var arr_field_name = field_name.split("_");
      var last_idx = arr_field_name.pop();
      if(last_idx == "answertext]")
      {
          var fldnm = arr_field_name.join("_")+"_selectedoptions";
          field_val = $('input[name="' + fldnm + '"]:checked').val();
          if(field_val==undefined) field_val="";
      }
      if(field_val == "")
        return true;
      else
        return false;
    }
</script>