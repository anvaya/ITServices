<?php /* @var $order order */ ?>
<?php use_helper('I18N'); ?>
<div id="main_content" style="width: 960px;">   
    <div id="content" class="col-full">
        <div id="main-sidebar-container">
            <div id="main">
                <div class="post-144 page type-page status-publish hentry">
                    <h2 class="title"><?php echo __('Thank you for your order !', null, 'messages') ?></h2>						                
                    <br />
                    
                    <br />
                    <div class="entry">
                        <p style="font-weight: bold">Your order no. is: <?php echo $order->getOrderNo();?></p>
                        <p>You will receive an email with payment instructions shortly.</p>                                                
                    </div>
                </div>
            </div>
        </div>
    </div>
    <p><?php echo link_to('Go To Home Page','@homepage'); ?></p>
  <div style="clear:both;"></div>
</div>