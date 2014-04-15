<style>
	.email_body  { font-family: 'Helvetica Neue', 'Segoe UI', Helvetica, Arial, 'Lucida Grande', sans-serif; font-size: 15px; } 
	.email_body td,  .email_body th { text-align: left; padding-left: 4px; }
        .email_body th { font-weight: bold; }
	.green_btn  {  background-color: green; padding: 4px; font-weight: bold; color: white; text-decoration: none; border: 1px solid #eee; } 
        p { margin-top: 5px; }
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
                    Dear <?php /* @var $user member */ echo $user->getQualifiedName();?>,                    
		</p>

		<p>Thank you for registering with us. As part of your subscription, you can file income tax return for <?php echo $current_fy;?>. However, if you wish to file for the previous year <?php echo $prev_fy ?>, you can purchase it separately for just 50% charge through this special offer. Please use the following coupon code when you purchase the service.
                </p>                     
                <br />
                <table bgcolor="#E2E1DD" cellpadding="5" cellspacing="10" height="138" style="line-height:normal;" width="600" id="yui_3_13_0_1_1396444206637_2435">
                <tbody id="yui_3_13_0_1_1396444206637_2434">
                <tr id="yui_3_13_0_1_1396444206637_2433">
                <td bgcolor="#009999" height="116" style="font-family:Arial, Helvetica, sans-serif;font-size:14px;color:#FFFFFF;" width="316" id="yui_3_13_0_1_1396444206637_2441"><span style="font-size:25px;">Income Tax Return FY <?php echo $prev_fy ?></span><br>
                <br>
                use Coupon Code:<br>
                <span style="font-size:25px;text-transform:uppercase;" id="yui_3_13_0_1_1396444206637_2443"><strong id="yui_3_13_0_1_1396444206637_2442"><?php echo $coupon_code ?></strong></span><br>
                </td>
                <td align="center" bgcolor="#FFFFFF" style="color:#888888;font-family:Arial, Helvetica, sans-serif;font-size:12px;" valign="middle" width="232" id="yui_3_13_0_1_1396444206637_2432">
                <table cellpadding="0" height="100%" width="94%" id="yui_3_13_0_1_1396444206637_2447">
                <tbody id="yui_3_13_0_1_1396444206637_2450">
                <tr id="yui_3_13_0_1_1396444206637_2452">
                <td height="63" id="yui_3_13_0_1_1396444206637_2451">
                <table border="0" cellpadding="5" style="font-family:Arial, Helvetica, sans-serif;font-size:12px;" width="100%" id="yui_3_13_0_1_1396444206637_2456">
                <tbody id="yui_3_13_0_1_1396444206637_2455">
                <tr>
                    <td colspan="2">&nbsp;</td>
                </tr>
                <tr id="yui_3_13_0_1_1396444206637_2454">
                <td colspan="2" id="yui_3_13_0_1_1396444206637_2453">Valid till<strong id="yui_3_13_0_1_1396444206637_2457"> <?php echo $valid_till ?></strong></td>
                </tr>
                </tbody>
                </table>
                </td>
                </tr>
                <tr id="yui_3_13_0_1_1396444206637_2449">
                <td align="right" height="33" id="yui_3_13_0_1_1396444206637_2448"><a rel="nofollow" style="font-family:Arial, Helvetica, sans-serif;font-size:12px;">Terms &amp; Conditions Apply</a></td>
                </tr>
                </tbody>
                </table>
                </td>
                </tr>
                </tbody>
                </table>                
               		
                <p>&nbsp;</p>
		<p>Please <a href="<?php echo public_path("index.php/default/contact");?>">Contact Us</a> in case you have any queries.</p>
		
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