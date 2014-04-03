<?php use_stylesheet('member/form.css'); ?>
<div id="sf_admin_container">
  <div class="fg-toolbar ui-widget-header ui-corner-all">
      <div class="ui-dialog-title" style="padding: 3px 5px 5px 3px">
          <h1 style="margin-bottom: 0px;">Products List</h1>
      </div>
  </div>
  <div id="sf_admin_content">
    <?php //echo $form->renderGlobalErrors() ?>
    <div class="sf_admin_form_row sf_admin_text">
        <div>
          <label><?php echo "Product Code"; ?></label>
          <div class="content">
              <?php echo $product->getCode(); ?>
          </div>
        </div>
    </div>
    <div class="sf_admin_form_row sf_admin_text">
        <div>
          <label><?php echo "Name"; ?></label>
          <div class="content">
              <?php echo $product->getName(); ?>
          </div>
        </div>
    </div>
    <div class="sf_admin_form_row sf_admin_text">
        <div>
          <label><?php echo "Category"; ?></label>
          <div class="content">
              <?php echo $product->getProductCategory(); ?>
          </div>
        </div>
    </div>
    <div class="sf_admin_form_row sf_admin_text">
        <div>
          <label><?php echo "Description"; ?></label>
          <div class="content">
              <?php echo $product->getDescription(); ?>
          </div>
        </div>
    </div>
    <div class="sf_admin_form_row sf_admin_text">
        <div>
          <label><?php echo "Expiry Date"; ?></label>
          <div class="content">
              <?php echo $product->getExpiryDate(); ?>
          </div>
        </div>
    </div>
    <div class="sf_admin_form_row sf_admin_text">
        <div>
          <label><?php echo "Form"; ?></label>
          <div class="content">
              <?php echo $product->getSubmissionForm(); ?>
          </div>
        </div>
    </div>
    <div class="sf_admin_form_row sf_admin_text">
        <div>
          <label><?php echo "Price"; ?></label>
          <div class="content">
              <?php echo $product->getPrice(); ?>
          </div>
        </div>
    </div>
    <div class="sf_admin_form_row sf_admin_text">
        <div>
          <label>&nbsp;</label>
          <div class="content">
            &nbsp;<a href="<?php echo url_for('@product_index?page=1') ?>" class="purple-btn">Back to list</a>
            <a href="<?php echo url_for('@cart_add?id='.$product->getId()) ?>" class="green-btn">Add To Cart</a>
            <?php /* <input type="submit" value="Add To Cart" class="green-btn" /> */ ?>
          </div>
        </div>
    </div>
  </div>
</div>