<?php use_helper('Url','JavascriptBase');?>
<div class="sf_admin_form_row">
    <div style="padding-left: 5px; padding-top: 5px; padding-bottom: 5px;">      
      
          <ul class="sf_admin_actions" style="margin: 2px; display: inline-block;">
              <li class="sf_admin_action_new">
                <?php echo link_to_function("Add Option","add_option_row()",array('class'=>'fg-button ui-state-default fg-button-icon-left add_new_image')) ;?>            
              </li>
          </ul>
          <span id="lblItemsError" class="ui-corner-all ui-state-error"></span>        
      
    </div>
    <div class="sf_admin_list ui-grid-table ui-widget ui-corner-all ui-helper-reset ui-helper-clearfix">
      <table id="option_items">
          <thead class="ui-widget-header">            
              <th class="ui-state-default ui-th-column" scope="col">Option #</th>            
              <th class="ui-state-default ui-th-column" scope="col">Text</th>
              <th class="ui-state-default ui-th-column" scope="col">Value</th>            
              <th class="ui-state-default ui-th-column" scope="col">Pre-selected</th>
              <th class="ui-state-default ui-th-column" scope="col">Actions</th>
          </thead>
          <tbody>
               <?php foreach($form["options"] as $key=>$subform):?>            
                   <?php include_partial("question_bank/option",array("key"=>$key, "item"=>$subform));?>
              <?php endforeach;?>   
          </tbody>
          <tfoot>
              <tr>
                  <td colspan="7">&nbsp;</td>
              </tr>
          </tfoot>
      </table>
    </div>
</div>

<script type="text/javascript">
    
    var search_asset_id = 0;
    var item_count = <?php echo count($form['options']); ?>;
    
     function remove_item(key)
    {
        if(confirm("Remove this Option?"))
        {
            $("#question_bank_options_"+key+"_remove").val(0);
            $("#items_"+key).css("display","none"); 
        }
    }    
    
    $(document).ready(function()
    {
        $('#question_bank_answer_type').change(function()
        {
            selected_value = $(this).val();
            
            if(selected_value)
            {
                switch(selected_value)
                {
                    case '<?php echo questionTable::ANSWER_TYPE_SINGLE_CHOICE ?>':
                    case '<?php echo questionTable::ANSWER_TYPE_MULTI_CHOICE ?>':
                        $('#sf_fieldset_options').css('display','block');
                        break;
                    default:
                        $('#sf_fieldset_options').css('display','none');
                        break;
                }
            }            
        });   
    });
    
    function add_option_row()
    {
       $('#lblItemsError').css('display','none');
       
       var code=$('#txtCode').val();       
       
       var id = $('#question_bank_id').val();
       if(!id) id=0;                   
                     
       var url = '<?php echo url_for("@question_bank_option_row?id=-2&num=-1");?>';
       
       url = url.replace("-1", item_count);       
       url = url.replace("-2", id);        
       
       
       $.ajax({
                url: url ,
                processData: false,                
                success: function(data, textSuccess) { addrow_success(data, textSuccess);},
                error: function(data, textStatus, errorThrown) 
                {
                    $('#lblItemsError').text('Error:'+data.statusText); 
                    $('#lblItemsError').css('display','inline-block');                    
                },
                async: false
              });
    }    
    
    function addrow_success(data, textSuccess)
    {
        item_count++;
        $('tbody', $('#option_items')).append(data);    
    }
</script>    