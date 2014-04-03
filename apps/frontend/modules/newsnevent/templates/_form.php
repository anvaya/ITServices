<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="<?php echo url_for('newsnevent/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table>
    <tfoot>
      <tr>
        <td colspan="2">
          <?php echo $form->renderHiddenFields(false) ?>
          &nbsp;<a href="<?php echo url_for('newsnevent/index') ?>">Back to list</a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to('Delete', 'newsnevent/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => 'Are you sure?')) ?>
          <?php endif; ?>
          <input type="submit" value="Save" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form->renderGlobalErrors() ?>
      <tr>
        <th><?php echo $form['is_event']->renderLabel() ?></th>
        <td>
          <?php echo $form['is_event']->renderError() ?>
          <?php echo $form['is_event'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['event_date']->renderLabel() ?></th>
        <td>
          <?php echo $form['event_date']->renderError() ?>
          <?php echo $form['event_date'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['picture_file']->renderLabel() ?></th>
        <td>
          <?php echo $form['picture_file']->renderError() ?>
          <?php echo $form['picture_file'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['title']->renderLabel() ?></th>
        <td>
          <?php echo $form['title']->renderError() ?>
          <?php echo $form['title'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['subtitle']->renderLabel() ?></th>
        <td>
          <?php echo $form['subtitle']->renderError() ?>
          <?php echo $form['subtitle'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['event_body']->renderLabel() ?></th>
        <td>
          <?php echo $form['event_body']->renderError() ?>
          <?php echo $form['event_body'] ?>
        </td>
      </tr>
      <tr>
        <th><?php echo $form['disabled']->renderLabel() ?></th>
        <td>
          <?php echo $form['disabled']->renderError() ?>
          <?php echo $form['disabled'] ?>
        </td>
      </tr>
    </tbody>
  </table>
</form>
