<?php
/* @var $form memberForm */
$member = $form->getObject();

$active_subscription = $member->getCurrentActiveSubscription();

$subscription = member_subscriptionTable::getInstance() 
                        ->createQuery('ms')
                        ->addWhere('ms.member_id = ?', $member->getId())
                        ->orderBy('ms.id desc')
                        ->fetchOne();  
      

/* @var $subscription member_subscription */
if($subscription && !$subscription->getActive()):
    
    $old_subscriptions = member_subscriptionTable::getInstance()
                            ->createQuery('ms')
                            ->addWhere('ms.member_id = ?', $member->getId())
                            ->addWhere('ms.id <> ?', $subscription->getId())
                            ->count();
    
?>
  <h3>
      <?php if($old_subscriptions == 0):?>
        The Member Subscription is not active
        <?php $link_title = "Activate Subscription";?>
      <?php else:?>
        Current Subscription: <?php echo $active_subscription->getSubscription()->getName(); ?><br /><br />
        
        The Member has requested a renewal.    
        <?php $link_title = "Renew Subscription";?>
      <?php endif;?>  
  </h3>
  
  <?php if( ($coupon = $subscription->getMemberCoupon()) && $coupon->getId() > 0  ):?>
        <?php $coupon_member = $coupon->getMember(); /* @var $coupon_member member */ ?>
        This member has used a 50% coupon issued to <?php echo link_to($coupon_member->getFirstName()." ".$coupon_member->getLastName(),"member/edit?id=".$coupon_member->getId(), array("target"=>"_blank") ) ; ?>. Please verify before activation.
        <br /><br />
  <?php endif;?>
  
  <?php echo link_to($link_title,"member/activate?id=".$member->getId(),array("onclick"=>"return activate_subscription();", "class"=>"fg-button ui-state-default fg-button-icon-left"));?>
  
    
  <script type="text/javascript">
      
      function activate_subscription()
      {
          try
          {
            //var subscription_id = $('#sf_guard_user_subscription_subscription_id').val();
            var url             = "<?php echo url_for("member/activate?id=".$member->getId().""); ?>";
            //url                 = url.replace("-1", subscription_id);

            location.href = url;          
          }catch(e)
          {               
          }
          return false;
      }
  </script>
<?php endif; ?>

    

