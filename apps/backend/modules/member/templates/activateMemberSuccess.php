<style type='text/css'>
       #notice
       {
           margin: 5px;
           font-weight: bold;
           font-size: 1.1em;
           color: red;
           padding: 5px;
       }
</style>

<h1>Activate Member</h1>
<br />
<div id='notice'>
</div>
<table>
    <tr>
    <th><label for="member_name">Enter Member's name </label></th>
    <td>&nbsp;<input type="hidden" name="member_name" id="member_name" /><input type="text" size='60' name="autocomplete_member_name" id="autocomplete_member_name" /><script type="text/javascript">
  jQuery(document).ready(function() {
    jQuery("#autocomplete_member_name")
    .autocomplete(
            {
               source: '<?php echo url_for("@member_autocomplete") ?>',
               select: function(event, ui) 
               {                    
                   event.preventDefault();
                   $('#member_name').val(ui.item.value);
                   $('#autocomplete_member_name').val(ui.item.label);
               },
               focus: function(event, ui) 
               {
                    event.preventDefault();
                    $('#autocomplete_member_name').val(ui.item.label);
               }            
            }) 
    });
    
    function activateMember()
    {
        var member_id = $('#member_name').val();
        if(member_id.length > 0)
        {
            $('#notice').html("Processing....");
            var url = "<?php echo url_for("member/activate?id=-1") ?>";
            url = url.replace('-1', member_id);
            $.ajax(
                    {
                        'url': url,
                        'success': function(data)
                        {
                            var msg = "";
                            
                            if(data==='1')
                            {
                                msg = "Member Activated Successfully.";
                            }
                            else
                            {
                                msg = "Member Activation Failed";
                            }
                            
                            $('#notice').html(msg);
                            $('#member_name').val("");
                            $('#autocomplete_member_name').val("");
                            
                        }
                    }                    
            );
        }
    }
</script><input type="hidden" name="_csrf_token" value="b918c2b579727f6708eb4a571f73295f" id="csrf_token" /></td>
</tr>
<tr>
    <td colspan='2' style='text-align: center'>
        <br />
        <a class='green-btn' href='#' onclick='activateMember(); return false'>Activate</a>
    </td>
</tr>
</table>