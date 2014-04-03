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
        Dear <?php /* @var $user sfGuardUser */ echo $user->getFirstName();?>,
      </p>
      <p>Thank you for itr information. In order to ensure that we can give each return the time and attention necessary to do a thorough and accurate job, we request that you send your tax amount as soon as possible.</p>

      <div class="order_info">
        <table>
          <tr><th align="left">Product:</th><td><?php echo $itr_submission->getProduct(); ?></td></tr>
          <tr><th align="left">Date:</th><td><?php echo format_date($itr_submission->getCreatedAt(), "f"); ?></td></tr>
          <tr><th align="left">Pan No.:</th><td><?php echo $itr_submission->getPanNo(); ?></td></tr>
          <tr><th align="left">Tax Due:</th><td><?php echo $itr_submission->getTaxDue(); ?></td></tr>
          <tr><th align="left">Due Date:</th><td><?php echo $itr_submission->getDueDate(); ?></td></tr>
        </table>
      </div>		

      <p>Please complete the bank transfer of your order payment as per the details below: </p>
      <hr />
      <div class="payment_info">
        <table>
          <tr><th align="left">Bank name and Branch:</th><td>AXIS Bank, Madhav Nagar, Nagpur</td></tr>
          <tr><th align="left">Account Name:</th><td>GROWORTH REAL SOLUTIONS PRIVATE LIMITED</td></tr>
          <tr><th align="left">Account No:</th><td>913020050376549</td></tr>
          <tr><th align="left">IFSC Code for NEFT / RTGS</th><td>UTIB0000639</td></tr>
          <tr><th align="left">Swift Code</th><td>AXISINBB048</td></tr>
          <tr><th align="left">Amount</th><td><?php //echo $total_amount; ?></td></tr>
        </table>
      </div>		
      <hr />
      <p><b>After you have made the payment:</b></p>
      <p>&nbsp;</p>
      <?php $url = url_for("/member.php/itr/paymentVerified?verify=$link", true);?>
      <p>Please click <a href="<?php echo $url ?>" target="_blank">here</a> to notify us of your payment for quick processing.</p>
      <p>&nbsp;</p>
      <p>Please <a href="<?php echo url_for("default/contact", true) ?>">Contact Us</a> in case you have any queries.</p>
      <p>&nbsp;</p>
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