<?php use_helper('I18N'); ?>
<div id="main_content" style="width: 960px;">   
    <div id="content" class="col-full">
        <div id="main-sidebar-container">
            <div id="main">
                <div class="post-144 page type-page status-publish hentry">
                    <h2 class="title"><?php echo __('Thank you !', null, 'messages') ?></h2>						                
                    <br />
                    <div class="entry">
                        <p>Your registration application has been submitted successfully.</p>
                        <p>
                            You will shortly receive an email containing details of payment. Please follow the instructions therein to activate your account.
                        </p>
                        <p>Please <a href="<?php echo url_for("default/contact") ?>">contact us</a> in case you have any queries or feedback.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
  <p><?php echo link_to('Go To Home Page','@homepage'); ?></p>
  <div style="clear:both;"></div>
</div>