<?php
  /* @var $itr_submission itr_submission */
  /* @var $other_income itr_other_income */

  $arr_category = array(
      1 => 'Dividend received during the year2',
      2 => 'Interest received during the year',
      3 => 'Rent Received from other than House property (such as machinery, vehicles Etc.',
      4 => 'Gift Received - Details of gift received for the value exceeding 50,000 from single person.',
      5 => 'Miscellaneous Income : Details of income such as winning from lottery or any other income which is not covered in any of the source above.'
      );
      $other_incomes = itr_other_incomeTable::getInstance()
                        ->createQuery('ic')
                        ->addWhere('submission_id=?',$itr_submission->getId())
                        ->orderBy('category_id asc')
                        ->execute();
?>
<?php  ?>
<div class="sf_admin_list ui-grid-table ui-widget ui-corner-all ui-helper-reset ui-helper-clearfix">
<table>
  <tbody>
    <tr class="fg-toolbar ui-widget-header ui-corner-all">      
      <th class="sf_admin_text ui-state-default ui-th-column">Date Received</th>
      <th class="sf_admin_text ui-state-default ui-th-column">Amount</th>
      <th class="sf_admin_text ui-state-default ui-th-column">Details</th>
    </tr>
    <?php $last_category = -1;?>
    <?php foreach($other_incomes as $key => $other_income): ?>
      
      <?php if($last_category != $other_income->getCategoryId()):?>
        <tr>
            <th colspan="3" class="sf_admin_text ui-state-default ui-th-column"><?php echo $arr_category[$other_income->getCategoryId()]; ?></th>
        </tr>
        <?php $last_category = $other_income->getCategoryId();?>
      <?php endif;?>
        
    
      <tr class="sf_admin_row ui-widget-content">        
        <td class="sf_admin_text"><?php echo format_date($other_income->getDateRcvd(),'dd/MM/y'); ?></td>
        <td class="sf_admin_text"><?php echo $other_income->getAmount(); ?></td>
        <td class="sf_admin_text"><?php echo $other_income->getDetails(); ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
</div>