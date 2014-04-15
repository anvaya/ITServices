<?php /* @var $order order */ ?>
<?php use_helper('I18N'); ?>
<div id="main_content" style="width: 960px;">   
    <div id="content" class="col-full">
        <div id="main-sidebar-container">
            <div id="main">                
                <div class="post-144 page type-page status-publish hentry">
                    <?php if($result=="SAVED"):?>
                        <h2 class="title"><?php echo __('Thank you for your order !', null, 'messages') ?></h2>						                
                        <br />

                        <br />
                        <div class="entry">
                            <p style="font-weight: bold">Your renewal request has been registered successfully.</p>
                            <p>You will receive an email with payment instructions shortly.</p>                                                
                        </div>
                    <?php elseif($result=="ALREADY_REQUESTED"):?>
                        <br />
                        <br />

                        <br />
                        <div class="entry">
                            <p style="font-weight: bold">We have already received your renewal request.</p>                            
                        </div>                        
                    <?php elseif($result=="ALREADY_RENEWED"):?>
                        <br />
                        <br />

                        <br />
                        <div class="entry">
                            <p style="font-weight: bold">Your subscription is already up to date, renewal not required.</p>
                        </div>                        
                    <?php endif;?>    
                </div>
            </div>
        </div>
    </div>
    <p><?php echo link_to('Go To Home Page','@homepage'); ?></p>
  <div style="clear:both;"></div>
</div>