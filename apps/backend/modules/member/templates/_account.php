<?php
/* @var $form memberForm */
$member = $form->getObject();
$subscription = member_subscriptionTable::getInstance() 
                        ->createQuery('ms')
                        ->addWhere('ms.member_id = ?', $member->getId())
                        ->orderBy('ms.id desc')
                        ->fetchOne();
/* @var $subscription member_subscription */
if($subscription && !$subscription->getActive()):
?>
  <h3>The Member Subscription is not active</h3>
  
  <?php if( ($coupon = $subscription->getMemberCoupon()) ):?>
        <?php $coupon_member = $coupon->getMember(); /* @var $coupon_member member */ ?>
        This member has used a 50% coupon issued to <?php echo link_to($coupon_member->getFirstName()." ".$coupon_member->getLastName(),"member/edit?id=".$coupon_member->getId(), array("target"=>"_blank") ) ; ?>. Please verify before activation.
        <br /><br />
  <?php endif;?>
  
  <?php echo link_to("Activate Subscription","member/activate?id=".$member->getId(),array("onclick"=>"return activate_subscription();", "class"=>"fg-button ui-state-default fg-button-icon-left"));?>
  
    
  <script type="text/javascript">
      
      function activate_subscription()
      {
          try
          {
            var subscription_id = $('#sf_guard_user_subscription_subscription_id').val();
            var url             = "<?php echo url_for("member/activate?id=".$member->getId()."&sid=-1"); ?>";
            url                 = url.replace("-1", subscription_id);

            location.href = url;          
          }catch(e)
          {               
          }
          return false;
      }
  </script>
<?php endif; ?>

    

