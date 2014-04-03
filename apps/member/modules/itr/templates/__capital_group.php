<?php 
        $np = "itr_submission[".$sub_form_name."]['+\$index()+']";
        $npp = "itr_submission[".$sub_form_name."]['+\$parent.itemIndex()+'][purchase_info]['+\$index()+']";
        $date_min = "new Date(".$fy.",3,1)";
        $date_max = "new Date(".($fy+1).",2,31,23,59,59)";
?>
<table>
    <tbody data-bind="foreach: <?php echo $viewModelItem ?>">
        <tr data-bind="visible: detailsVisible()=='0'">
            <td valign="top">
                 <?php echo image_tag("stock_certificate.png");?>
            </td>
            <td colspan="2" style="vertical-align: middle;">
                <div style="display: inline-block; min-width: 350px;">
                    Sold <span data-bind="text: qty"></span> <span data-bind="text: name"></span> for Rs.<span data-bind="text: sell_value"></span> 
                </div>
                <a href="#" data-bind="click: toggleDetails"><?php echo image_tag("black/edit.png",array("title"=>"Edit","width"=>"32")); ?></a>
            </td>
        </tr>
        <tr data-bind="visible: detailsVisible()=='1'" >
            <td valign="top" style="text-align: center; vertical-align: top;">               
                  <?php echo image_tag("stock_certificate.png");?> <br />
                  <a href="#" data-bind="click: toggleDetails"><?php echo image_tag("black/minus.png",array("title"=>"Hide Details","width"=>"24")); ?></a>            
            </td>
            <td>
                <table>
                        <tr>
                            <td>
                                <label data-bind="attr: {'for': 'name_' + $index() }" ><?php echo $details_label ?></label>                            
                            </td>
                            <td>
                                <input type='text' data-bind="value: name, attr: {name: '<?php echo $np;?>[details]', id: 'name_' + $index() }" />                                
                                <input type='hidden' data-bind="attr: {name: '<?php echo $np;?>[id]'}, value: id" />
                                <input type='hidden' data-bind="attr: {name: '<?php echo $np;?>[category_id]'}" value="<?php echo $itemIndex?>"/>
                                <span class="help_icon" data-bind="attr: {'onclick':'showHelp(this);'}" help_id="capital_<?php echo $itemIndex ?>_details"></span>
                            </td>
                        </tr>

                        <!-- ko template: {'if': hasError("date_sale")} -->	
                        <tr class="error">
                            <td colspan="2" data-bind="text: errors['date_sale']"></td>
                        </tr>
                        <!-- /ko -->
                        
                        <tr>
                            <td>
                                <label data-bind="attr: {'for': 'selldate_' + $index() }" >Date of Sale</label>                            
                            </td>
                            <td>
                                <!--
                                <input type='hidden' data-bind="value: date_sold, attr: {name: '<?php echo $np;?>[date_sale]', id: 'selldate_' + $index() }" />
                                -->
                                <div data-bind="attr: {name: '<?php echo $np;?>[date_sale]'},jqxDateTimeInput: {value: date_sold, min: <?php echo $date_min;?>, max: <?php echo $date_max ?>, disabled: false, height: '25px', width: '134px' }" ></div>
                                <span class="help_icon" style="display: none;" data-bind="attr: {'onclick':'showHelp(this);'}" help_id="capital_<?php echo $itemIndex ?>_date_sold" ></span>
                            </td>
                        </tr>

                        <!-- ko template: {'if': hasError("quantity_sold")} -->	
                        <tr class="error">
                            <td colspan="2" data-bind="text: errors['quantity_sold']"></td>
                        </tr>
                        <!-- /ko -->
                        
                        <tr>
                            <td>
                                <label data-bind="attr: {'for': 'qty_' + $index() }" ><?php  echo $qty_label; ?></label>                            
                            </td>
                            <td>
                                <input type="text" autocomplete="off" data-bind="attr: {'onkeypress': 'return isNumber(event);', 'onkeyup': 'enableTooltip(this);', name:'<?php echo $np;?>[quantity_sold]', 'class': 'number_input'}, value: qty" />                                
                                <!--
                                <div  data-bind="attr: {name:'<?php echo $np;?>[quantity_sold]', 'class': 'number_input'}, jqxNumberInput: {events: { 'change': 'alert();' }, inputMode: 'simple' ,  value: qty, disabled: false, min: 1, decimalDigits: 0, spinButtons: false, height: '18px', width: '134px' }" />                                                                
                                -->
                                <span class="help_icon" style="display: none;" data-bind="attr: {'onclick':'showHelp(this);'}" help_id="capital_<?php echo $itemIndex ?>_qty"></span>
                            </td>
                        </tr>
                           
                        <tr>
                            <td>
                                <label data-bind="attr: {'for': 'value_' + $index() }" >Sale Value</label>                            
                            </td>
                            <td>                                                               
                                <input type='text' autocomplete="off" class="number_input" data-bind="value: sell_value, attr: {'onkeypress': 'return isNumber(event);', 'onkeyup': 'enableTooltip(this);', name: '<?php echo $np;?>[sell_value]', id: 'value_' + $index() }" />
                                <span class="help_icon" style="display: none;" data-bind="attr: {'onclick':'showHelp(this);'}" help_id="capital_<?php echo $itemIndex ?>_sell_value" ></span>
                            </td>
                        </tr>

                        <tr>
                            <td colspan='2'>
                                <h3 class="bold">Details of expenditure done for selling</h3>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label data-bind="attr: {'for': 'brokerage_' + $index() }" >Paid to Broker</label>                            
                            </td>
                            <td>                                
                                <input type='text' autocomplete="off" class="number_input" data-bind="value: brokerage, attr: {'onkeypress': 'return isNumber(event);', 'onkeyup': 'enableTooltip(this);', name: '<?php echo $np;?>[brokerage_paid]', id: 'brokerage_' + $index() }" />                                
                                <span class="help_icon" style="display: none;" data-bind="attr: {'onclick':'showHelp(this);'}" help_id="capital_<?php echo $itemIndex ?>_brokerage" ></span>
                            </td>
                        </tr>

                        <tr style="display: none;">
                            <td>
                                <label data-bind="attr: {'for': 'othexp_' + $index() }" >Other Expenses</label>                            
                            </td>
                            <td>                                
                                <input type='text' class="number_input" autocomplete="off" data-bind="value: other_charges, attr: {'onkeypress': 'return isNumber(event);', 'onkeyup': 'enableTooltip(this);', name: '<?php echo $np;?>[other_expenses]', id: 'othexp_' + $index() }" />
                                <span class="help_icon" data-bind="attr: {'onclick':'showHelp(this);'}" help_id="capital_<?php echo $itemIndex ?>_other_exp" ></span>
                            </td>
                        </tr>     
                </table>
            </td>
            <td>        
                <p class="bold">Purchase Details of quantity sold
                <span class="help_icon" data-bind="attr: {'onclick':'showHelp(this);'}" help_id="capital_<?php echo $itemIndex ?>_purchase"></span></p>
                <button class="purple-btn" data-bind="attr: {onclick: 'myViewModel.addPurchaseInfoRow(<?php echo $itemIndex;?>,' + $index() + ');return false;'}">Add Row</button>
                
                <table cellspacing="0" class="capital_purchase">
                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>
                                Date Purchased
                                <span class="help_icon" style="display: none;" data-bind="attr: {'onclick':'showHelp(this);'}" help_id="capital_<?php echo $itemIndex ?>_purchase_date" ></span>
                            </th>
                            <th>Qty. Purchased
                                <span class="help_icon" style="display: none;" data-bind="attr: {'onclick':'showHelp(this);'}" help_id="capital_<?php echo $itemIndex ?>_purchase_qty" ></span>
                            </th>
                            <th>Purchase Value <br/> (Inclusive of Expenses)
                                <span class="help_icon" style="display: none;" data-bind="attr: {'onclick':'showHelp(this);'}" help_id="capital_<?php echo $itemIndex ?>_cost" ></span>
                            </th>
                        </tr>
                    </thead>
                    <tbody data-bind="foreach: purchaseInfo">
                        <tr>
                            <td data-bind="text: $index() + 1"></td>
                            <td>                                
                                <div data-bind="attr: {name: '<?php echo $npp; ?>[date]'},jqxDateTimeInput: {value: date, max: new Date(), disabled: false, height: '25px', width: '134px' }" ></div>
                            </td>
                            <td>                                
                                <input type="text" autocomplete="off" class="number_input" data-bind="attr: {'onkeypress': 'return isNumber(event);', 'onkeyup': 'enableTooltip(this);',name: '<?php echo $npp;?>[quantity]'},value: quantity" />
                            </td>
                            <td>                                
                                <input type="text" autocomplete="off" class="number_input" data-bind="attr: {'onkeypress': 'return isNumber(event);', 'onkeyup': 'enableTooltip(this);',name: '<?php echo $npp;?>[cost]'},value: cost" />
                            </td>
                        </tr>
                    </tbody>
                </table>                
            </td>
        </tr>
    </tbody>
</table>