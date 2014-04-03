<?php
  /* @var $itr_submission itr_submission */
  /* @var $security itr_securities */
  $arr_cp_category = array(
    1 => 'Investments in Shares in India Shares (listed in stock Exchange)',
    2 => 'Investments in Shares in India Shares (unlisted)',
    3 => 'Investments in other Securities  Debentures/ Bonds (Listed in Stock Exchange)',
    4 => 'Investments in other Securities  Debentures/ Bonds (Unlisted)',
    5 => 'Any other assets sold during the year such as, House property / land / motor /vehicles etc.',
    6 => 'Investments in Mutual Funds in India',
    7 => 'Immovable Property Sold'
  );

  $securities = itr_securitiesTable::getInstance()
                    ->createQuery('it')
                    ->addWhere('submission_id = ?', $itr_submission->getId())
                    ->orderBy('category_id asc')
                    ->addWhere('category_id > 0')
                    ->execute();
  
  $last_category = -1;
?>
<div class="sf_admin_list ui-grid-table ui-widget ui-corner-all ui-helper-reset ui-helper-clearfix">
<table><tbody>
  <?php foreach($securities as $key => $security): ?>        
  <tr><td style="padding: 5px;">
    <table>
    <tbody>
      <?php if($last_category != $security->getCategoryId()):?>  
        <tr class="fg-toolbar ui-widget-header ui-corner-all">
          <th class="sf_admin_text ui-th-column" colspan="4" style="padding:4px;"><?php echo $arr_cp_category[$security->getCategoryId()] ?></th>
        </tr>
        <?php $last_category = $security->getCategoryId();?>
      <?php endif;?>      
      
      <tr class="sf_admin_row ui-widget-content">
        <th class="sf_admin_text ui-state-default ui-th-column" colspan="2">Selling Details</td>
        <th class="sf_admin_text ui-state-default ui-th-column" colspan="2">Purchase Details</td>
      </tr>
      <tr class="sf_admin_row ui-widget-content">
        <th class="sf_admin_text ui-state-default ui-th-column">Details</th>
        <td class="sf_admin_text" ><?php echo $security->getDetails(); ?></td>
        <td class="sf_admin_text" rowspan="6" valign="top">
          <?php
            //ToDo :: decode json             
            $arr_pi = json_decode($security->getPurchaseInfo(),true);
            if(!$arr_pi) $arr_pi = array();            
          ?>            
          <table>
                <thead>
                    <tr>
                        <th class="sf_admin_text ui-state-default ui-th-column">Date</th>
                        <th class="sf_admin_text ui-state-default ui-th-column">Qty</th>
                        <th class="sf_admin_text ui-state-default ui-th-column">Cost</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($arr_pi as $prow):?>
                    <tr>
                        <td><?php $date_array = explode("GMT", $prow['date']); $date = strtotime( $date_array[0]); echo date('d/m/Y', $date);?></td>
                        <td><?php echo $prow['quantity'];?></td>
                        <td><?php echo $prow['cost'];?></td>
                    </tr>
                    <?php endforeach;?>
                </tbody>            
          </table>
            
          <?php if($last_category == 7): ?>
                <?php $arr_cost = json_decode($security->getAddonCosts(), true); if(!is_array($arr_cost)) $arr_cost=  array(); ?>
                <br />
                Major cost of Improvement Done (Renovation / Additional Construction etc) 
                <table>
                    <thead>
                        <tr>
                            <th class="sf_admin_text ui-state-default ui-th-column">Date</th>
                            <th class="sf_admin_text ui-state-default ui-th-column">Particulars of Work</th>
                            <th class="sf_admin_text ui-state-default ui-th-column">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($arr_cost as $prow):?>
                        <tr>
                            <td><?php echo $prow['date']; // $date_array = explode("GMT", $prow['date']); $date = strtotime( $date_array[0]); echo date('d/m/Y', $date);  ?></td>
                            <td><?php echo $prow['details'];?></td>
                            <td><?php echo $prow['amount'];?></td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>            
                </table>
          <?php endif;?>  
        </td>
      </tr>
      <tr class="sf_admin_row ui-widget-content">
        <th class="sf_admin_text ui-state-default ui-th-column">Date of Sale</th>
        <td class="sf_admin_text" ><?php echo $security->getDateSale(); ?></td>
      </tr>
      <tr class="sf_admin_row ui-widget-content">
        <th class="sf_admin_text ui-state-default ui-th-column">Quantity Sold</th>
        <td class="sf_admin_text" ><?php echo $security->getQuantitySold(); ?></td>
      </tr>
      <tr class="sf_admin_row ui-widget-content">
        <th class="sf_admin_text ui-state-default ui-th-column">Sell Value</th>
        <td class="sf_admin_text" ><?php echo $security->getSellValue(); ?></td>
      </tr>
      <tr class="sf_admin_row ui-widget-content">
        <th class="sf_admin_text ui-state-default ui-th-column" colspan="2">Details of expenditure done for selling</th>
      </tr>
      <tr class="sf_admin_row ui-widget-content">
        <th class="sf_admin_text ui-state-default ui-th-column">Paid to Broker</th>
        <td class="sf_admin_text" ><?php echo $security->getBrokeragePaid(); ?></td>
      </tr>
      <tr class="sf_admin_row ui-widget-content">
        <th class="sf_admin_text ui-state-default ui-th-column">Other Expenses</th>
        <td class="sf_admin_text" ><?php echo $security->getOtherExpenses(); ?></td>
      </tr>
    </tbody>
    </table>
  </td></tr>
  <?php endforeach; ?>
</tbody></table>
</div>