<script type="text/javascript">
    $(document).ready(function(){
        $('#subform_personaldetail_6_6_Y').click(function()
        {
            $('#q_7').show(500);
            $('#q_8').show(500);
            $('#q_9').show(500);
            $('#q_10').show(500);
        });
        
        $('#subform_personaldetail_6_6_N').click(function()
        {
            $('#q_7').hide();
            $('#q_8').hide();
            $('#q_9').hide();
            $('#q_10').hide();
        });
        
        $('#subform_residentialaddress_23_4').change(function()
        {
           if($(this).val!=='IN')
           {
               $('#q_24').show(500);
               $('#subform_residentialaddress_22_1').removeClass('required');
           }
           else
           {
               $('#q_24').hide();
               $('#subform_residentialaddress_22_1').addClass('required');
           }
        });
        
        $('#subform_residentialaddress_21_14').change(function()
        {
            if($(this).val()==='99') //Outside India
            {
                $('#q_23').show(500);
                $('#q_24').show(500);
                $('#subform_residentialaddress_22_1').removeClass('required').val('0');
                $('#q_22').hide();
            }
            else
            {
                $('#subform_residentialaddress_22_1').addClass('required');
                $('#q_22').show();                
                $('#q_23').hide(500);
                $('#q_24').hide(500);
            }
        });
        
        $('#subform_officeaddress_31_14').change(function()
        {
            if($(this).val()==='99') //Outside India
            {
                $('#q_33').show(500);
                $('#q_34').show(500);
                $('#subform_officeaddress_32_1').removeClass('required').val('0');
                $('#q_32').hide();
            }
            else
            {
                $('#subform_officeaddress_32_1').addClass('required');
                $('#q_32').show();                
                $('#q_33').hide(500);
                $('#q_34').hide(500);
            }
        });        
                
        $('#subform_incometype_44_7_02').click(function()
        {
            $('#q_45').hide();            
            
            if($(this).is(":checked"))
            {
                $('#q_45').show(50);
            }            
        });
        
        $('#subform_incometype_44_7_03').click(function()
        {            
            $('#q_46').hide();
            
            if($(this).is(":checked"))
            {
                $('#q_46').show(50);
            }                        
        });
        
        $('#subform_representative_49_1').change(function()
        {
            $('#q_61').show();
            $('#q_62').show();
            
            var val = $(this).val();
            if(val.length > 0)
            {
                $('#subform_documentsenclosed_62_0').addClass('required');
                $('#subform_documentsenclosed_61_0').addClass('required');
            }
            else
            {
                $('#subform_documentsenclosed_62_0').removeClass('required');
                $('#subform_documentsenclosed_61_0').removeClass('required');
            }
        });
        
        $('#detailed_help').dialog(
            {
                autoOpen: false,
                title: 'Information',
                width: 800,
                height: 600,
                hide: 'clip'
            });
        
        $('img', '.help_icon').click(function()
        {
            var id = $(this).attr('group_code');
            var source = $('#help_'+id).html();
            if(source === undefined)
                source = "No Information";
            $('pre','#detailed_help').html(source);
            $('#detailed_help').dialog('open');
        });
        
        $('#q_7').hide();
        $('#q_8').hide();
        $('#q_9').hide();
        $('#q_10').hide();
        $('#q_23').hide();
        $('#q_24').hide();
        $('#q_33').hide(500);
        $('#q_34').hide(500);
        $('#q_45').hide();
        $('#q_46').hide();
        $('#q_61').hide();
        $('#q_62').hide();
});


  function validateForm()
    {
      var err = "";
      var name, value;
      var err_flg = 0;
      $('input.required').each(function()
      {
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
 
           var ul_id = $('#error_list_'+ $(this).attr('qid'));
           
           if($.trim(value) === "")
           {            
                var id = $(this).attr('id');   
                var err = errormsg($(this).attr('id'),'select');
                var ul_id = $('#error_list_'+ $(this).attr('qid'));
                $('li', ul_id).html(err);
                $(ul_id).show();
                err_flg = 1;            
           }
           else
               $(ul_id).hide();

          /*
          if($.trim(value) == "")
          {
            //var id = $(this).attr('id');
            var pp_div = $(this).parent().parent().parent();
            $(pp_div).children('.error_list').remove();

            var p_div = $(this).closest('div'); //parent('div'); //.parent();
            var already_added = $('.error_list', p_div.parent());

            if(!already_added.length)
            {
                err_flg = 1;
                $('<ul class="error_list"><li>'+err+'</li></ul>').insertBefore(p_div);
            }
          }*/ 
        });
        
        $('select.required').each(function()
        {
           value = $(this).val();                  
           var ul_id = $('#error_list_'+ $(this).attr('qid'));
           
           if($.trim(value) === "")
           {            
            var id = $(this).attr('id');   
            var err = errormsg($(this).attr('id'),'select');
            var ul_id = $('#error_list_'+ $(this).attr('qid'));
            $('li', ul_id).html(err);
            $(ul_id).show();
            err_flg = 1;
            
            /*
            //var id = $(this).attr('id');
            var pp_div = $(this).parent().parent().parent();
            $(pp_div).children('.error_list').remove();

            var p_div = $(this).closest('div'); //parent('div'); //.parent();
            var already_added = $('.error_list', p_div.parent());

            if(!already_added.length)
            {
                err_flg = 1;
                var err = errormsg($(this).attr('id'),'select');
                $('<ul class="error_list"><li>' +err+ '</li></ul>').insertBefore(p_div);
            }*/
           }
           else
               $(ul_id).hide();
        });
        if(err_flg === 1)
          return false;
    }
    
    function errormsg(field_id,field_type)
    {
          var err = "";
          var _attr = $('#'+field_id).attr('error_msg');
          if(typeof _attr !== "undefined" && _attr !== false && _attr !== null){
            err = $('#'+field_id).attr('error_msg');
          }
          if(err === "")
          {
            err = "You must provide an answer";
          }
          
          return err;
    }    
</script>
