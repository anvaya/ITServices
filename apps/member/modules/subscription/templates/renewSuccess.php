<?php use_stylesheet('member/ticket.css'); ?>
<div id="sf_admin_container">
  <div class="fg-toolbar ui-widget-header ui-corner-all">
      <div class="ui-dialog-title" style="padding: 3px 5px 5px 3px">
          <h1 style="margin-bottom: 0px;">Renew Subscription</h1>
      </div>
  </div>

  <div id="sf_admin_content">
      <div class="sf_admin_list">
        <div class="sf_admin_flashes ui-widget">
            <?php if ($sf_user->hasFlash('notice')): ?>
              <div class="notice ui-state-highlight ui-corner-all">
                <span class="ui-icon ui-icon-info floatleft"></span>&nbsp;
                <?php echo __($sf_user->getFlash('notice'), array(), 'sf_admin') ?>
              </div>
            <?php endif; ?>

            <?php if ($sf_user->hasFlash('error')): ?>
              <div class="error ui-state-error ui-corner-all">
                <span class="ui-icon ui-icon-alert floatleft"></span>&nbsp;
                <?php echo __($sf_user->getFlash('error'), array(), 'sf_admin') ?>
              </div>
            <?php endif; ?>
        </div>
        
        <table>
          <thead>
            <tr>
              <th>Subscription</th>              
              <th>Price</th>
            </tr>
          </thead>
          <tbody>
            <?php $price = 0; ?>
            
            <tr class="sf_admin_row odd">
              <td><?php echo $currentSubscription->getName() ?></td>              
              <td style="text-align: right;"><?php echo $currentSubscription->getCurrency()." ". number_format($currentSubscription->getPrice()-$discount_amount,2); ?></td>
            </tr>           
            
          </tbody>
        </table>
        
        <div class="sf_admin_form_row sf_admin_text">                               
            <div style="width: 50%; text-align: left; display: inline-block">
            &nbsp;<a href="<?php echo url_for('@product_index?page=1') ?>" class="purple-btn">Cancel</a>
            </div>
            <div style="width: 49%; text-align: right; display: inline-block">                
                &nbsp;<?php echo link_to("Order Now","subscription/renewConfirm", array("class"=>"green-btn","confirm"=>"Placing your order, are you sure?") );?>
            </div>
            <?php /* <input type="submit" value="Add To Cart" class="green-btn" /> */ ?>
        </div>
        
      </div>
  </div>
</div>