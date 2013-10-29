Dear <?php echo $sf_guard_user->getFirstName() ?>,
<br/><br/>
Your PAN application has been submitted successfully to our processing desk.
<br/>
Our representative will contact you shortly.
<br/>
Please First pay the payment and click the following link to complete the Verified payment.
<br><br>
<?php $url = url_for("@panapplication_paymentVerified?payment=$link", true);?>
<a href="<?php echo $url ?>" target="_blank">Payment Verification</a>
