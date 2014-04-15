<?php
    $order = $form->getObject();
    $member = $order->getMember();
    
    /* @var $order order */
    $display_data = array(
        "Order No"=>$order->getOrderNo(),
        "Date"=>format_date($order->getOrderDate(),"dd/M/y"),
        "Member"=>$member->getLastName()." ".$member->getFirstName(),              
        "Net Amount"=>$order->getNetAmount()
    );
?>
<?php foreach($display_data as $key=>$data):?>
<?php $field_key = strtolower(str_replace(" ", "_", $key)) ?>
<div class="sf_admin_form_row sf_admin_text sf_admin_form_field_<?php echo $field_key ?>">
    <div>
        <label for="<?php echo $field_key ?>"><?php echo $key ?></label>
        <div class="content">
            <?php echo $data; ?>
        </div>
    </div>
</div>
<?php endforeach;?>
     

