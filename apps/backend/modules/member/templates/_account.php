<?php
/* @var $form memberForm */
$member = $form->getObject();
$subscription = member_subscriptionTable::getInstance() 
                        ->createQuery('ms')
                        ->addWhere('ms.member_id = ?', $member->getId())
                        ->orderBy('ms.id desc')
                        ->fetchOne();
/* */
if($subscription && !$subscription->getActive()):
?>
  <h3>The Member Subscription is not active</h3>
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

    

