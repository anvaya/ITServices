<?php use_helper('JavascriptBase'); use_stylesheet('member/ticket.css'); ?>
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
        
        <form method="get" action="<?php echo url_for("subscription/renewConfirm") ?>" >
            <table>
              <thead>
                <tr>
                  <th>Subscription</th>              
                  <th>Price</th>
                </tr>
              </thead>

              <tfoot>            
                <tr class="sf_admin_row odd" >
                    <td colspan="2" style="text-align: right" id="coupon_row_col">
                        Have a special coupon ? Enter the code here.
                        &nbsp;<input type="text" size="12" maxlength="10" id="cart_coupon_code" />                    
                        &nbsp;<?php echo link_to_function("Apply", "apply_coupon();", array("class"=>"purple-btn") );?>
                    </td>    
                </tr>            
              </tfoot>

              <tbody>
                <?php $price = 0; ?>

                <tr class="sf_admin_row odd">
                  <td><?php echo $currentSubscription->getName() ?></td>              
                  <td style="text-align: right;" id="price_col"><?php echo $currentSubscription->getCurrency()." ". number_format($currentSubscription->getPrice()-$discount_amount,2); ?></td>
                </tr>           
                
                <tr class="sf_admin_row even" style="display: none" id="coupon_added_row">
                  <td style="text-align: right" >Special Coupon</td>              
                  <td style="text-align: right;" id="price_col_coupon"></td>
                </tr>           
                
              </tbody>          
            </table>
            <input type="hidden" name="cc" id="cc" value="" />
        
          
            <div class="sf_admin_form_row sf_admin_text">                               
                <div style="width: 50%; text-align: left; display: inline-block">
                &nbsp;<a href="<?php echo url_for('@product_index?page=1') ?>" class="purple-btn">Cancel</a>
                </div>
                <div style="width: 49%; text-align: right; display: inline-block">                
                    &nbsp;<input type="submit" value="Order Now" onclick="return confirm('Placing your order, are you sure?');" class="green-btn" />                
                </div>
                <?php /* <input type="submit" value="Add To Cart" class="green-btn" /> */ ?>
            </div>
        </form>
      </div>
  </div>
</div>
<script type="text/javascript">    
    function apply_coupon()
    {        
        var cc  = $('#cart_coupon_code').val();
        if(cc.length == 0)
        {
            alert('Please enter the coupon code');
            $('#cart_coupon_code').focus();
            return;
        }
        
        var url = "<?php echo url_for("subscription/checkCoupon?cc=-1") ?>";        
        url = url.replace("-1", cc);
        
        $.ajax(
                {
                    url: url,
                    dataType: 'json',
                    success: function(data, textSuccess) 
                    {
                        var subscription_price = <?php echo $currentSubscription->getPrice(); ?>;
                        var currency_code = '<?php echo $currentSubscription->getCurrency(); ?>';
                        
                        if(data.amount > 0)
                        {
                            $('#cc').val(cc);                            
                            $('#price_col_coupon').html('- ' + currency_code + ' ' + data.amount);
                            $('#coupon_added_row').show();
                            $('#coupon_row_col').html('You Pay: ' + currency_code + ' ' + (subscription_price - data.amount) );
                        }
                        else
                        {
                            alert('Invalid Coupon Code.');
                            $('#cart_coupon_code').val('');
                        }
                    }
                });
        
    }
</script>