<style>
	.email_body  { font-family: 'Helvetica Neue', 'Segoe UI', Helvetica, Arial, 'Lucida Grande', sans-serif; font-size: 15px; } 
	.email_body td,  .email_body th { text-align: left; padding-left: 4px; }
        .email_body th { font-weight: bold; }
	.green_btn  {  background-color: green; padding: 4px; font-weight: bold; color: white; text-decoration: none; border: 1px solid #eee; } 
        p { margin-top: 5px; }
</style>
<table border="0" class="email_body"><?php /* @var $order order */ ?>

<tr>
	<td>
                <?php echo image_tag("logo3.jpg",array("absolute"=>true,"alt"=>"Groworth Real Solutions Pvt. Ltd."));?>		
	</td>		
</tr>
<tr>
	<td>
		<br />
		<p>
			Dear <?php /* @var $user sfGuardUser */ echo $user->getFirstName();?>,
		</p>

                <p>We have received your payment for order #<?php echo $order->getOrderNo() ?>. </p>
                <p>&nbsp;</p>
                <p>Details of your Order:</p>
                <hr />
                <div class="payment_info">
                    <table>
                        <table>
                            <tr><th align="left">Order No:</th><td><?php echo $order->getOrderNo() ?></td></tr>
                            <tr><th align="left">Date:</th><td><?php echo format_date($order->getOrderDate(),"dd/M/y"); ?></td></tr>
                            <tr><th align="left">Amount:</th><td>AED <?php echo $amount; ?></td></tr>
			</table>
                    </table>
		</div>	
                <hr />
                <p>&nbsp;</p>                
		<p>Following Services have been added to your account: </p>
		<hr />
		<div class="payment_info">
			<table>
                                <?php foreach($products as $key=>$product): ?>
                                    <tr><th align="left"><?php echo $key+1;?>.&nbsp;<?php echo $product['product_name'] ?></th></tr>
				<?php endforeach;?>
			</table>
		</div>		
		<hr />
		<p><b>You can see all your services under "My Services" menu in the member's area.</b></p>
                <p>&nbsp;</p>                
		<p>Please <a href="<?php echo url_for("default/contact", true) ?>">Contact Us</a> in case you have any queries.</p>		
		<br />
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
