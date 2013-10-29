<?php use_helper('I18N'); use_stylesheet("member/form.css"); ?>
<div id="main_content" style="width: 960px;">   
    <div id="content" class="col-full">
        <div id="main-sidebar-container">
            <div id="main">
                <div class="post-144 page type-page status-publish hentry">
                    <h2 class="title"><?php echo __('Thank you !', null, 'messages') ?></h2>						                
                    <br />
                    <div class="entry">
                        <p>Your PAN application has been submitted successfully to our processing desk.</p>
                        <p>Our representative will contact you shortly.</p>                        
                        <p>Please <a href="/contactus.html">contact
us</a> in case you have any queries or feedback.</p>
                        <p>Payment detail</p>
                        <p>Bank : HDFC Bank</p>
                        <p>IFCI CODE : 12AB</p>
                        <p>Bank Account No.:1234567891234567</p>
                        <p>After payment click link in email and add payment detail for verification</p>
                        <p>When you finish your transaction, please click on email link to return back to the site.</p> 

                    </div>
                </div>
            </div>
        </div>
    </div>
  <p><?php echo link_to('Go To Home Page','@homepage'); ?></p>
  <div style="clear:both;"></div>
</div>