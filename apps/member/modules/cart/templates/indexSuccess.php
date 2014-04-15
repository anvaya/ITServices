<?php use_helper('JavascriptBase'); use_stylesheet('member/ticket.css'); ?>
<div id="sf_admin_container">
  <div class="fg-toolbar ui-widget-header ui-corner-all">
      <div class="ui-dialog-title" style="padding: 3px 5px 5px 3px">
          <h1 style="margin-bottom: 0px;">My Cart</h1>
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
        <?php if($carts): ?>
        <table>
          <thead>
            <tr>
              <th>Product</th>
              <th>Quantity</th>
              <th>Price</th>
            </tr>
          </thead>
          <tbody>
            <?php $price = 0; ?>
            <?php foreach ($carts as $cart): ?>
            <tr class="sf_admin_row odd">
              <td><?php echo $cart->getProduct() ?></td>
              <td style="text-align: center;"><?php echo $cart->getQuantity() ?></td>
              <td style="text-align: right;">US $<?php echo $cart->getPrice() ?></td>
            </tr>
            <?php $price += $cart->getPrice(); ?>
            <?php endforeach; ?>
            
            <?php if( ($coupon = $shoppingCart->getMemberCoupon()) && $coupon->getId() > 0 ): /*  @var $member_coupon member_coupon */ ?>
                <tr class="sf_admin_row odd">
                  <th style="text-align: right;" colspan="2">Special Coupon <?php  echo $coupon->getCouponCode(); ?></th>                  
                  <td style="text-align: right;">- US $<?php echo $coupon->getCoupon()->getDiscountRate(); ?></td>
                </tr>
                <?php $price -= $coupon->getCoupon()->getDiscountRate();?>
            <?php else:?>
                <tr class="sf_admin_row odd">
                    <td colspan="3" style="text-align: right">
                        Have a special coupon ? Enter the code here.
                        &nbsp;<input type="text" size="12" maxlength="10" id="cart_coupon_code" />
                        &nbsp;<?php echo link_to_function("Apply", "apply_coupon();", array("class"=>"green-btn") );?>
                    </td>    
                </tr>
            <?php endif;?>
            
            <tr>
                <th style="text-align: left;" colspan="2">Total Amount</th>
                <th style="text-align: right;">US $<?php echo $price; ?></th>
            </tr>
          </tbody>
        </table>
        <div class="sf_admin_form_row sf_admin_text">                               
            <div style="width: 50%; text-align: left; display: inline-block">
            &nbsp;<a href="<?php echo url_for('@product_index?page=1') ?>" class="purple-btn">Back to Services</a>
            </div>
            <div style="width: 49%; text-align: right; display: inline-block">
                &nbsp;<?php echo link_to("Clear Cart","cart/clear", array("class"=>"purple-btn","confirm"=>"Clearing your cart, are you sure?") );?>
                &nbsp;<?php echo link_to("Order Now","cart/checkout", array("class"=>"green-btn","confirm"=>"Placing your order, are you sure?") );?>
            </div>
            <?php /* <input type="submit" value="Add To Cart" class="green-btn" /> */ ?>
        </div>
        <?php endif; ?>
      </div>
  </div>
</div>
<script type="text/javascript">
    function apply_coupon()
    {
        var code = $('#cart_coupon_code').val();
        var url  = "<?php echo url_for("@cart_apply_coupon?code=-1") ?>";
        url = url.replace("-1", code);
        location.href = url;
    }
</script>