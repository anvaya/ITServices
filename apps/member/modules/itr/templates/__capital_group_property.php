<?php 
        $np = "itr_submission[".$sub_form_name."]['+\$index()+']";
        $npp = "itr_submission[".$sub_form_name."]['+\$parent.itemIndex()+'][purchase_info]['+\$index()+']";
?>
<table>
    <tbody data-bind="foreach: <?php echo $viewModelItem ?>">    
         <tr data-bind="visible: detailsVisible()=='0'">                            
             <td valign="top">
                <?php echo image_tag("House-Sold.png");?>  
             </td>
            <td colspan="2" style="vertical-align: middle">
                <div style="display: inline-block; min-width: 350px;">
                    Sold property at <span data-bind="text: name"></span> for Rs.<span data-bind="text: sell_value"></span> 
                </div>                
                <span style="display: inline-block">
                    <a href="#" style="margin-top: 10px;" data-bind="click: toggleDetails"><?php echo image_tag("black/edit.png",array("title"=>"Edit","width"=>"32")); ?></a>            
                </span>
            </td>
        </tr>
        <tr data-bind="visible: detailsVisible()=='1'">
            <td valign="top" align="center">                 
                <?php echo image_tag("House-Sold.png");?>  
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
                                <span class="help_icon" data-bind="attr: {'onclick':'showHelp(this);'}" help_id="capital_property_details"></span>
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
                                <div data-bind="attr: {name: '<?php echo $np;?>[date_sale]'},jqxDateTimeInput: {value: date_sold, max: new Date(), disabled: false, height: '25px', width: '134px' }" ></div>                                                                
                                <span class="help_icon" data-bind="attr: {'onclick':'showHelp(this);'}" help_id="capital_property_date_sale"></span>
                            </td>
                        </tr>

                        <!-- ko template: {'if': hasError("quantity_sold")} -->	
                        <tr class="error">
                            <td colspan="2" data-bind="text: errors['quantity_sold']"></td>
                        </tr>
                        <!-- /ko -->
                        
                        <tr style="display: none;">
                            <td>
                                <label data-bind="attr: {'for': 'qty_' + $index() }" ><?php  echo $qty_label; ?></label>                            
                            </td>
                            <td>
                                <input type="text" value="1" class="number_input" readonly="readonly" data-bind="attr: {'onkeyup': 'enableTooltip(this);', name:'<?php echo $np;?>[quantity_sold]', 'class': 'number_input'}" />                                                                                               
                            </td>
                        </tr>
                           
                        <tr>
                            <td>
                                <label data-bind="attr: {'for': 'value_' + $index() }" >Sale Value</label>                            
                            </td>
                            <td>                                
                                <input type='text' class="number_input" autocomplete="off" data-bind="value: sell_value, attr: {'onkeypress': 'return isNumber(event);', 'onkeyup': 'enableTooltip(this);',name: '<?php echo $np;?>[sell_value]', id: 'value_' + $index() }" />
                                <span class="help_icon" data-bind="attr: {'onclick':'showHelp(this);'}" help_id="capital_property_sale_value"></span>
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
                                <input type='text' class="number_input" autocomplete="false" data-bind="value: brokerage, attr: {'onkeypress': 'return isNumber(event);', 'onkeyup': 'enableTooltip(this);',name: '<?php echo $np;?>[brokerage_paid]', id: 'brokerage_' + $index() }" />                                
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label data-bind="attr: {'for': 'othexp_' + $index() }" >Other Expenses</label>                            
                            </td>
                            <td>
                                <input type='text' class="number_input" autocomplete="off" data-bind="value: other_charges, attr: {'onkeypress': 'return isNumber(event);', 'onkeyup': 'enableTooltip(this);',name: '<?php echo $np;?>[other_expenses]', id: 'othexp_' + $index() }" />
                                <span class="help_icon" data-bind="attr: {'onclick':'showHelp(this);'}" help_id="capital_property_other_exp"></span>
                            </td>
                        </tr>     
                </table>
            </td>
            <td>        
                <p class="bold">Cost of Acquisition ( Total amount for which property was purchased)</p>                
                <table cellspacing="0" class="capital_purchase">
                    <thead>
                        <tr>                            
                            <th>
                                Date
                                <span class="help_icon" data-bind="attr: {'onclick':'showHelp(this);'}" help_id="capital_property_purchase_date"></span>
                            </th>                                                        
                            <th>
                                Cost of Acquisition
                                <span class="help_icon" data-bind="attr: {'onclick':'showHelp(this);'}" help_id="capital_property_purchase_cost"></span>
                            </th>
                        </tr>
                    </thead>
                    <tbody data-bind="foreach: purchaseInfo">
                        <tr>                            
                            <td>
                                <input type="hidden" data-bind="attr: {name: '<?php echo $npp; ?>[date]'},value: date" />
                                <div data-bind="jqxDateTimeInput: {value: date, max: new Date(), disabled: false, height: '25px', width: '134px' }" ></div>
                            </td>
                            <td>                                
                                <input type="hidden" value="1" data-bind="attr: {name: '<?php echo $npp;?>[quantity]'}" />                                
                                <input type="text" class="number_input" autocomplete="off" data-bind="attr: {'onkeypress': 'return isNumber(event);', 'onkeyup': 'enableTooltip(this);',name: '<?php echo $npp;?>[cost]'},value: cost" />
                            </td>
                        </tr>
                    </tbody>
                </table>                
                
                <br />
                
                <?php $npp = "itr_submission[".$sub_form_name."]['+\$parent.itemIndex()+'][addon_costs]['+\$index()+']";?>
                <p class="bold">Major cost of Improvement Done (Renovation / Additional Construction etc)
                    <span class="help_icon" data-bind="attr: {'onclick':'showHelp(this);'}" help_id="capital_property_addon_costs"></span>
                </p>
                <button class="purple-btn" data-bind="attr: {onclick: 'myViewModel.addCostsRow(<?php echo $itemIndex;?>,' + $index() + ');return false;'}">Add Row</button>
                <table cellspacing="0" class="capital_purchase">
                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Date (Approximate)</th>     
                            <th>Particulars of work done</th>
                            <th>Amount</th>                            
                        </tr>
                    </thead>
                    <tbody>
                        <tbody data-bind="foreach: addonCosts">
                        <tr>
                            <td data-bind="text: $index() + 1"></td>
                            <td><div data-bind="attr: {name: '<?php echo $npp; ?>[date]'}, jqxDateTimeInput: {value: date, max: new Date(), disabled: false, height: '25px', width: '134px' }" ></div></td>
                            <td><input type="text" class="details" data-bind="attr: {name: '<?php echo $npp; ?>[details]'}, value: details" /></td>
                            <td><input type="text" class="number_input" autocomplete="off" data-bind="attr: {'onkeypress': 'return isNumber(event);', 'onkeyup': 'enableTooltip(this);',name: '<?php echo $npp; ?>[amount]'}, value: amount" /></td>                            
                        </tr>                        
                    </tbody>
                </table>
                
                
            </td>
        </tr>        
        <tr><td colspan="3" class="separator"></td></tr>
    </tbody>
</table>