<?php
  /* @var $itr_submission itr_submission */
  /* @var $itr_exemption itr_exemption */
?>
<?php $itr_exemptions = $itr_submission->getItrExemption() ?>
<div class="sf_admin_list ui-grid-table ui-widget ui-corner-all ui-helper-reset ui-helper-clearfix">
<table>
  <tbody>
    <tr class="fg-toolbar ui-widget-header ui-corner-all">
      <th class="sf_admin_text ui-state-default ui-th-column">Category</th>
      <th class="sf_admin_text ui-state-default ui-th-column">Amount</th>
    </tr>
    <?php foreach($itr_exemptions as $key => $itr_exemption): ?>
      <tr class="sf_admin_row ui-widget-content">
        <td class="sf_admin_text"><?php echo $itr_exemption->getExemptionCategory(); ?></td>
        <td class="sf_admin_text"><?php echo $itr_exemption->getAmount(); ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
</div>