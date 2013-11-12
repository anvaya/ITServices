<table class="sf_admin_form_row sf_admin_text">
  <?php /* <tr><th><?php echo $number ?></th></tr> */ ?>
  <thead><tr><td colspan="2"><?php echo image_tag('toggle_collapse.png', array('class'=>'toggle-property')) ?></td></tr></thead>
  <tbody class="table-subform">
  <?php foreach ($form['itrone_subs'] as $sub_key => $sub_form): ?>
    <?php if($sub_key == $number): ?>
      <?php foreach($sub_form as $sub_fields): ?>
        <?php if($sub_fields->isHidden()) continue; ?>
        <tr>
          <td><?php echo $sub_fields->renderLabel(); ?></td>
          <td><?php echo $sub_fields->render(); ?></td>
        </tr>
      <?php endforeach; ?>
      <tr><?php echo $sub_form->renderHiddenFields(); ?></tr>
    <?php endif; ?>
  <?php endforeach; ?>
  </tbody>
</table>
