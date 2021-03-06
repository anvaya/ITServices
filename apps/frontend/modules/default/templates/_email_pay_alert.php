<style>
	.email_body  { font-family: 'Helvetica Neue', 'Segoe UI', Helvetica, Arial, 'Lucida Grande', sans-serif; font-size: 15px; } 
	.email_body td,  .email_body th { text-align: left; padding-left: 4px; }
        .email_body th { font-weight: bold; }
	.green_btn  {  background-color: green; padding: 4px; font-weight: bold; color: white; text-decoration: none; border: 1px solid #eee; } 
</style>
<table border="0" class="email_body">

<tr>
	<td>
		 <?php echo image_tag("logo3.jpg",array("absolute"=>true,"alt"=>"Groworth Real Solutions Pvt. Ltd."));?>	
	</td>		
</tr>
<tr>
	<td>
		<br />
		<p>
			Hello Admin,
		</p>

                <p>A member has just confirmed <?php if($payment->getSubmissionId()):?> membership <?php else:?> renewal <?php endif;?>  payment.</p>

		<p>Transaction details below: </p>
		<hr />
		<div class="payment_info">
			<table><?php /* @var $payment payment */?>
				<tr><th align="left">Bank name:</th><td><?php echo $payment->getBankName(); ?></td></tr>
                                <tr><th align="left">Branch:</th><td><?php echo $payment->getBranch(); ?></td></tr>
				<tr><th align="left">Payment Ref. No. :</th><td><?php echo $payment->getPaymentRefNo(); ?></td></tr>
				<tr><th align="left">Transaction_id :</th><td><?php echo $payment->getTransactionId(); ?></td></tr>
				<tr><th align="left">Payment Date :</th><td><?php echo $payment->getPaymentDate(); ?></td></tr>				
                                <tr><th align="left">Amount</th><td>USD <?php echo $payment->getAmount(); ?></td></tr>
			</table>
		</div>		
		<hr />				
		<br />
		Sincerely,<br />
		Groworth Real Solutions Pvt. Ltd.
	</td>
</tr>
<tr>
    <td>
        <p>
        <br />
        <small>
            DISCLAIMER:<br />
            "Information contained and transmitted by this E-MAIL including any attachment is proprietary to Groworth Real Solutions Pvt. Ltd. and is intended solely for the addressee/s, and may contain information that is privileged, confidential or exempt from disclosure under applicable law. Access to this e-mail and/or to the attachment by anyone else is unauthorized. If this is a forwarded message, the content and the views expressed in this E-MAIL may not reflect those of the company. If you are not the intended recipient, an agent of the intended recipient or a person responsible for delivering the information to the named recipient, you are notified that any use, distribution, transmission, printing, copying or dissemination of this information in any way or in any manner is strictly prohibited.
            If you are not the intended recipient of this mail kindly delete from your system and inform the sender.
            There is no guarantee that the integrity of this communication has been maintained and nor is this communication free of viruses, interceptions or interference".
        </small>
        </p>
    </td>
</tr>

</table>