<div id="main_content" style="width: 960px;">   
  <div id="content" class="col-full">
    <div id="main-sidebar-container">
      <div id="main">
        <div class="post-144 page type-page status-publish hentry">
          <h2 class="title"><?php echo __('Try Again!', null, 'messages') ?></h2>						                
          <br />
          <div class="entry">
            <?php if ($sf_user->hasFlash('notice')): ?>
              <div class="notice"><?php echo __($sf_user->getFlash('notice'), array(), 'sf_admin') ?></div>
            <?php endif; ?>
            <p>We're sorry, but something went wrong while processing your payment confirmation!</p>
            <p>Your Payment confirmation not submitted.</p>
            <p>Please <a href="<?php url_for("default/contact") ?>">contact us</a> in case you have any queries or feedback.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>