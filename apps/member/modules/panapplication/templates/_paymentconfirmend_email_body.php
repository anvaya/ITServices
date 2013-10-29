Hi Admin,
<br /><br />
One payment received from <?php echo $sf_guard_user->getFirstName()." ". $sf_guard_user->getLastName(); ?>
<br/><br/>
payment Detail is bellow
<br><br>
Bank : <?php echo $payment->getBankName(); ?>
<br>
Branch : <?php echo $payment->getBranch(); ?>
<br>
Payment Ref. No. : <?php echo $payment->getPaymentRefNo(); ?>
<br>
Transaction_id : <?php echo $payment->getTransactionId(); ?>
<br>
Payment Date : <?php echo $payment->getPaymentDate(); ?>
<br>
Amount : <?php echo $payment->getAmount(); ?>