<?php
$np = "itr_submission[" . $sub_form_name . "]['+\$index()+']";
$npp = "itr_submission[" . $sub_form_name . "]['+\$parent.itemIndex()+'][purchase_info]['+\$index()+']";
?>
<table>
    <thead>
        <tr>
            <th>&nbsp;</th>
            <th colspan="4">Sell</th>            
            <th colspan="2">Expenses</th>            
        </tr>        
        <tr>
            <th>SNo.</th>
            <th><?php echo $details_label; ?></th>
            <th>Date of Sale</th>
            <th><?php echo $qty_label; ?></th>
            <th>Sell Value</th>
            <th>Paid to Broker</th>
            <th>Other Expenses</th>            
        </tr>
    </thead>
    <tbody data-bind="foreach: <?php echo $viewModelItem ?>">
        <tr>
            <td rowspan="2" valign="top" data-bind="text: $index()+1"></td>
            <td>
                <input type='text' data-bind="value: name, attr: {name: '<?php echo $np; ?>[details]', id: 'name_' + $index() }" />                                
                <input type='hidden' data-bind="attr: {name: '<?php echo $np; ?>[id]'}, value: id" />
                <input type='hidden' data-bind="attr: {name: '<?php echo $np; ?>[category_id]'}" value="<?php echo $itemIndex ?>"/>
            </td>
            <td>
                <!-- ko template: {'if': hasError("date_sale")} -->	                        
                <div class="error">
                    <span data-bind="text: errors['date_sale']"></span>                        
                </div>
                <!-- /ko -->                
                <input type='hidden' data-bind="value: date_sold, attr: {name: '<?php echo $np; ?>[date_sale]', id: 'selldate_' + $index() }" />
                <div data-bind="jqxDateTimeInput: {value: date_sold, max: new Date(), disabled: false, height: '25px', width: '134px' }" />                                
            </td>

            <td>
                <!-- ko template: {'if': hasError("quantity_sold")} -->	
                <div class="error">
                    <span colspan="2" data-bind="text: errors['quantity_sold']"></span>
                </div>
                <!-- /ko -->
                <div data-bind="jqxNumberInput: {value: qty, disabled: false, min: 1, decimalDigits: 0, spinButtons: false, height: '18px', width: '80px' }" />                                
                <input type='hidden' data-bind="value: qty, attr: {name: '<?php echo $np; ?>[quantity_sold]',id: 'qty_' + $index() }" />
            </td>

            <td>
                <div data-bind="jqxNumberInput: {value: sell_value, disabled: false, spinButtons: false, height: '18px', width: '134px' }" />                                
                <input type='hidden' data-bind="value: sell_value, attr: {name: '<?php echo $np; ?>[sell_value]', id: 'value_' + $index() }" />
            </td>

            <td>
                <div data-bind="jqxNumberInput: {value: brokerage, disabled: false, spinButtons: false, height: '18px', width: '134px' }" />                                
                <input type='hidden' data-bind="value: brokerage, attr: {name: '<?php echo $np; ?>[brokerage_paid]', id: 'brokerage_' + $index() }" />                                
            </td>

            <td>
                <div data-bind="jqxNumberInput: {value: other_charges, disabled: false, spinButtons: false, height: '18px', width: '134px' }" />                                
                <input type='hidden' data-bind="value: other_charges, attr: {name: '<?php echo $np; ?>[other_expenses]', id: 'othexp_' + $index() }" />
            </td>                     
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td colspan="5">        
                <p>Purchase Details of quantity sold</p>                
                <table cellspacing="0" class="capital_purchase">
                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Date Purchased</th>
                            <th>Qty. Purchased</th>
                            <th>Purchase Value <br/> (Inclusive of Expenses)</th>
                            <th><button class="purple-btn" data-bind="attr: {onclick: 'myViewModel.addPurchaseInfoRow(<?php echo $itemIndex; ?>,' + $index() + ');return false;'}">Add Row</button></th>
                        </tr>
                    </thead>
                    <tbody data-bind="foreach: purchaseInfo">
                        <tr>
                            <td data-bind="text: $index() + 1"></td>
                            <td>
                                <input type="hidden" data-bind="attr: {name: '<?php echo $npp; ?>[date]'},value: date" />
                                <div data-bind="jqxDateTimeInput: {value: date, max: new Date(), disabled: false, height: '25px', width: '134px' }" />                                
                            </td>
                            <td>
                                <div data-bind="jqxNumberInput: {value: quantity, decimalDigits: 0, disabled: false, spinButtons: false, height: '18px', width: '134px' }" />
                                <input type="hidden" data-bind="attr: {name: '<?php echo $npp; ?>[quantity]'},value: quantity" />
                            </td>
                            <td>
                                <div data-bind="jqxNumberInput: {value: cost, decimalDigits: 2, disabled: false, spinButtons: false, height: '18px', width: '134px' }" />
                                <input type="hidden" data-bind="attr: {name: '<?php echo $npp; ?>[cost]'},value: cost" />
                            </td>
                            <td>&nbsp;</td>
                        </tr>
                    </tbody>
                </table>                
            </td>
        </tr>
    </tbody>
</table>