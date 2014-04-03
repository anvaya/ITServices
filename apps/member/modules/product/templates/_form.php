<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('product/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('product/index') ?>">Back to list</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'product/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['code']->renderLabel() ?></th>
        <td>
          <?php echo $form['code']->renderError() ?>
          <?php echo $form['code'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['name']->renderLabel() ?></th>
        <td>
          <?php echo $form['name']->renderError() ?>
          <?php echo $form['name'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['description']->renderLabel() ?></th>
        <td>
          <?php echo $form['description']->renderError() ?>
          <?php echo $form['description'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['category_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['category_id']->renderError() ?>
          <?php echo $form['category_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['expiry_date']->renderLabel() ?></th>
        <td>
          <?php echo $form['expiry_date']->renderError() ?>
          <?php echo $form['expiry_date'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['expired']->renderLabel() ?></th>
        <td>
          <?php echo $form['expired']->renderError() ?>
          <?php echo $form['expired'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['billing_unit_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['billing_unit_id']->renderError() ?>
          <?php echo $form['billing_unit_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['form_id']->renderLabel() ?></th>
        <td>
          <?php echo $form['form_id']->renderError() ?>
          <?php echo $form['form_id'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['price']->renderLabel() ?></th>
        <td>
          <?php echo $form['price']->renderError() ?>
          <?php echo $form['price'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['template']->renderLabel() ?></th>
        <td>
          <?php echo $form['template']->renderError() ?>
          <?php echo $form['template'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
