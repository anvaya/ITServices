<?php use_helper('JavascriptBase');?>
<?php /* @var $item question_optionForm */ ?>
<tr id="items_<?php echo $key; ?>">    
    <td id="items_<?php echo $key;?>_display_order">    
        <?php echo $item['display_order'];?>
    </td>       
    <td id="items_<?php echo $key;?>_option_text"><?php echo $item['option_text'];?></td>
    <td id="items_<?php echo $key;?>_option_value"><?php echo $item['option_value'];?></td>
    <td align="center" id="items_<?php echo $key;?>_pre_selected"><?php echo $item['pre_selected'];?></td>    
    
    <td>
        <?php echo link_to_function(image_tag('/sfDoctrinePlugin/images/delete.png'), 'remove_item('.$key.');'); ?>
        <input type="hidden" name="question_bank[options][<?php echo $key ?>][remove]" id="question_bank_options_<?php echo $key;?>_remove" value=""/>
        <?php echo $item->renderHiddenFields();?>
    </td>        
</tr>
