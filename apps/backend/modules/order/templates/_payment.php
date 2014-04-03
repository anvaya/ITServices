<?php

$order = $form->getObject();
$payment = false;

/* @var $order order */
if($order->getPaymentId())
{
    $payment = $order->getPayment();
}?>    
<div class="sf_admin_form_row sf_admin_text">
<? if($payment): /* @var $payment payment */?>
<table>
    <tr>
        <th>Date</th>
        <td><?php echo format_date($payment->getPaymentDate(),"dd/M/y"); ?></td>
    </tr>
    <tr>
        <th>Payment Ref. No.</th>
        <td><?php echo $payment->getPaymentRefNo();?></td>
    </tr>
    <tr>
        <th>Amount</th>
        <td><?php echo $payment->getAmount();?></td>
    </tr>
    <tr>
        <th>Routed Through</th>
        <td><?php echo $payment->getRoutedThrough();?></td>
    </tr>
</table>
<?php else:?>
    <p>Payment information not available.</p>
<?php endif; ?>
</div>
