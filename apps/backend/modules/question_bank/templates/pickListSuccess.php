<?php use_helper("JavascriptBase","I18N","jQuery","Tag","Url");?>
<?php /* @var $grid sfDataGridDoctrine */ ?>

<div class="grid_action_bar">
    <button class="btnAdd">Add Selected</button> 
</div>
<?php echo sfOutputEscaper::unescape($grid_content); ?>
<div class="grid_action_bar">
    <button class="btnAdd">Add Selected</button> 
</div>
<?php  echo javascript_tag();  ?>
    $(document).ready(function()
    {
        bind_click();
        $('div#product').ajaxSuccess(function()
        {
          bind_click();
        });        
        
         $('.btnAdd').bind('click', function()
         {
            var ids = new Array();
            
            $('tr.row-selected').each(function(index)
            {
                //if(ids.length > 0) ids +=",";
                
                var chld    = $(this).children('td');

                var id      = $(chld[0]).html();                          
                
                ids[index] = id;
            });
            
            if(ids.length==0)
            {
                alert('Please select at least one question by clicking on it');
                return;
            }                        
            
            window.opener.picklist_callback(ids);
            
            self.close();
            
        });
    }
    );
    
    function bind_click()
    {
        $('tr.grid').bind('click',function(event)
        {
           row_clicked(this);           
        });
        
       
    }   

    function row_clicked(tr)
    {
        if($(tr).hasClass('row-selected'))
        {
            $(tr).removeClass('row-selected');
        }
        else
            $(tr).addClass('row-selected');
    }
    
    
<?php  echo end_javascript_tag();?>
