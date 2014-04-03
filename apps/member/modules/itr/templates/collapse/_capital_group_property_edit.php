<?php 
        $np = "";
        $npp = "";
        $details_label = "Address";
        ?><div id="newCapitalPropertyContainer" style="display: none;">
<table>
    <tbody>       
        <tr>
            <td valign="top" data-bind="text: $index()+1">                
            </td>
            <td>
                <table>
                        <tr>
                            <td>
                                <label data-bind="attr: {'for': 'name_' + $index() }" ><?php echo $details_label ?></label>                            
                            </td>
                            <td>
                                <input type='text' data-bind="value: name" />
                                <input type='hidden' data-bind="value: id" />
                                <input type='hidden' value="<?php echo $itemIndex?>"/>
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
                                <div data-bind="jqxDateTimeInput: {value: date_sold, max: new Date(), disabled: false, height: '25px', width: '134px' }" />                                                                
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
                                <input type="text" value="1"  readonly="readonly" data-bind="value: qty, attr: {'onkeyup': 'enableTooltip(this);', 'class': 'number_input'}" />                                                                                               
                            </td>
                        </tr>
                           
                        <tr>
                            <td>
                                <label data-bind="attr: {'for': 'value_' + $index() }" >Sell Value</label>                            
                            </td>
                            <td>                                
                                <input type='text' class="number_input" autocomplete="off" data-bind="value: sell_value, attr: {'onkeypress': 'return isNumber(event);', 'onkeyup': 'enableTooltip(this);', id: 'value_' + $index() }" />
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
                                <input type='text' class="number_input" autocomplete="false" data-bind="value: brokerage, attr: {'onkeypress': 'return isNumber(event);', 'onkeyup': 'enableTooltip(this);', id: 'brokerage_' + $index() }" />                                
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label data-bind="attr: {'for': 'othexp_' + $index() }" >Other Expenses</label>                            
                            </td>
                            <td>
                                <input type='text' class="number_input" autocomplete="off" data-bind="value: other_charges, attr: {'onkeypress': 'return isNumber(event);', 'onkeyup': 'enableTooltip(this);', id: 'othexp_' + $index() }" />
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
                                <div data-bind="jqxDateTimeInput: {value: date, max: new Date(), disabled: false, height: '25px', width: '134px' }" />                                
                            </td>
                            <td>                                
                                <input type="hidden" data-bind="value: quantity" />                                
                                <input type="text" class="number_input" autocomplete="off" data-bind="attr: {'onkeypress': 'return isNumber(event);', 'onkeyup': 'enableTooltip(this);'},value: cost" />
                            </td>
                        </tr>
                    </tbody>
                </table>                
                
                <br />
                
                <p class="bold">Major cost of Improvement Done (Renovation / Additional Construction etc)
                    <span class="help_icon" data-bind="attr: {'onclick':'showHelp(this);'}" help_id="capital_property_addon_costs"></span>
                </p>
                <table cellspacing="0" class="capital_purchase">
                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Date (Approximate)</th>     
                            <th>Particulars of work done</th>
                            <th>Amount</th>
                            <th><button class="purple-btn" data-bind="attr: {onclick: '$root.addCostsRow();return false;'}">Add Row</button></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tbody data-bind="foreach: addonCosts">
                        <tr>
                            <td data-bind="text: $index() + 1"></td>
                            <td><div data-bind="attr: {jqxDateTimeInput: {value: date, max: new Date(), disabled: false, height: '25px', width: '134px' }" /></td>
                            <td><input type="text" class="details" data-bind="value: details" /></td>
                            <td><input type="text" class="number_input" autocomplete="off" data-bind="attr: {'onkeypress': 'return isNumber(event);', 'onkeyup': 'enableTooltip(this);'}, value: amount" /></td>
                            <td>&nbsp;</td>
                        </tr>                        
                    </tbody>
                </table>
                
                
            </td>
        </tr>        
        <tr><td colspan="4" class="separator"></td></tr>
    </tbody>
</table></div>