<?php   $date_min = "new Date(".$fy.",3,1)";
        $date_max = "new Date(".($fy+1).",2,31,23,59,59)";
        $period = '01/04/'.($fy)." To 31/03/".($fy+1);
?><div id="page4" data-bind = "visible: currentPage() == 4">
    <h3>Details of other income received during the year. (<?php echo $period ?>)</h3>
    <br />
    <h4>1) Dividend received during the year</h4>
    <div><button class="purple-btn" onclick="myViewModel.addDivident(); return false;">Add Row</button></div><br />
    <?php $np = "itr_submission[otherincome1]['+\$index()+']"; ?>
    <table>
        <thead>
            <tr>
                <th>Details<span class="help_icon" help_id="other_income_divident_details" ></span></th>
                <th>Date Received</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody data-bind="foreach: dividentIncomes">
            <tr>
                <td><input type="text" data-bind="attr: {name: '<?php echo $np ?>[details]'},value: details" /></td>
                <td>
                    <div data-bind="jqxDateTimeInput: {value: date, min: <?php echo $date_min ?>, max: <?php echo $date_max ?>, disabled: false, height: '25px', width: '134px' }" ></div>                                 
                    <input type="hidden" data-bind="attr: {name: '<?php echo $np ?>[date_rcvd]'},value: date" />
                </td>
                <td>                                       
                    <input type='text' autocomplete="off" class="number_input" data-bind="value: amount, attr: {'onkeypress': 'return isNumber(event);', 'onkeyup': 'enableTooltip(this);', name: '<?php echo $np;?>[amount]'}" />                  
                    <input type="hidden" data-bind="attr: {name: '<?php echo $np ?>[id]'}, value: id" />
                    <input type="hidden" data-bind="attr: {name: '<?php echo $np ?>[category_id]'}" value="1" />
                </td>                
            </tr>
        </tbody>
    </table>    
    
    <?php $np = "itr_submission[otherincome2]['+\$index()+']"; ?>
    <h4>2) Interest received during the year</h4>
    <div><button class="purple-btn" onclick="myViewModel.addInterestIncome(); return false;">Add Row</button></div><br />
    <table>
        <thead>
            <tr>
                <th>Details of Deposit<span class="help_icon" help_id="other_income_int_details" ></span></th>
                <th>Date of Receipt</th>                
                <th>Amount</th>
            </tr>
        </thead>
        <tbody data-bind="foreach: interestIncomes">
            <tr>
                <td><input type="text" data-bind="attr: {name: '<?php echo $np ?>[details]'},value: details" /></td>
                <td>
                    <div data-bind="jqxDateTimeInput: {value: date, min: <?php echo $date_min ?>, max: <?php echo $date_max ?> , disabled: false, height: '25px', width: '134px' }" ></div>                                
                    <input type="hidden" data-bind="attr: {name: '<?php echo $np ?>[date_rcvd]'},value: date" />
                </td>
                <td>                    
                    <input type="text" autocomplete="off" class="number_input"  data-bind="attr: {'onkeypress': 'return isNumber(event);', 'onkeyup': 'enableTooltip(this);', name: '<?php echo $np ?>[amount]'},value: amount" />
                    <input type="hidden" data-bind="attr: {name: '<?php echo $np ?>[id]'}, value: id" />
                    <input type="hidden" data-bind="attr: {name: '<?php echo $np ?>[category_id]'}" value="2" />
                </td>                
            </tr>
        </tbody>
    </table>    
    
    <?php $np = "itr_submission[otherincome3]['+\$index()+']"; ?>
    <h4>3) Rent Received from other than House property (such as machinery, vehicles Etc.)</h4>
    <div><button class="purple-btn" onclick="myViewModel.addRentIncome(); return false;">Add Row</button></div><br />
    <table>
        <thead>
            <tr>
                <th>Details<span class="help_icon" help_id="other_income_rent_details" ></span></th>                
                <th>Total Amount Received in the Year</th>
            </tr>
        </thead>
        <tbody data-bind="foreach: rentIncomes">
            <tr>
                <td><input type="text" data-bind="attr: {name: '<?php echo $np ?>[details]'},value: details" /></td>                
                <td>                    
                    <input type="hidden" data-bind="attr: {name: '<?php echo $np ?>[date_rcvd]'},value: date" />
                    <input type="text" autocomplete="off" class="number_input" data-bind="attr: {'onkeypress': 'return isNumber(event);', 'onkeyup': 'enableTooltip(this);', name: '<?php echo $np ?>[amount]'},value: amount" />
                    <input type="hidden" data-bind="attr: {name: '<?php echo $np ?>[id]'}, value: id" />
                    <input type="hidden" data-bind="attr: {name: '<?php echo $np ?>[category_id]'}" value="3" />
                </td>                
            </tr>
        </tbody>
    </table>
    
    <?php $np = "itr_submission[otherincome4]['+\$index()+']"; ?>
    <h4>4) Gift Received - Details of gift received for the value exceeding 50,000 from single person.</h4>
    <div><button class="purple-btn" onclick="myViewModel.addGiftIncome(); return false;">Add Row</button></div><br />
    <table>
        <thead>
            <tr>
                <th>Details<span class="help_icon" help_id="other_income_gift_details" ></span></th>
                <th>Date of Receipt</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody data-bind="foreach: giftIncomes">
            <tr>
                <td><input type="text" data-bind="attr: {name: '<?php echo $np ?>[details]'},value: details" /></td>
                <td>
                    <div data-bind="jqxDateTimeInput: {value: date, min: <?php echo $date_min ?>, max: <?php echo $date_max ?>, disabled: false, height: '25px', width: '134px' }" ></div>                                
                    <input type="hidden" data-bind="attr: {name: '<?php echo $np ?>[date_rcvd]'},value: date" />
                </td>
                <td>                    
                    <input type="text" autocomplete="off" class="number_input" data-bind="attr: {'onkeypress': 'return isNumber(event);', 'onkeyup': 'enableTooltip(this);', name: '<?php echo $np ?>[amount]'},value: amount" />
                    <input type="hidden" data-bind="attr: {name: '<?php echo $np ?>[id]'}, value: id" />
                    <input type="hidden" data-bind="attr: {name: '<?php echo $np ?>[category_id]'}" value="4" />
                </td>                
            </tr>
        </tbody>
    </table>    
    
    <?php $np = "itr_submission[otherincome5]['+\$index()+']"; ?>
    <h4>5) Miscellaneous Income : Details of income such as winning from lottery or any other income which is not covered in any of the source above.</h4>
    <div><button class="purple-btn" onclick="myViewModel.addMiscIncome(); return false;">Add Row</button></div><br />
    <table>
        <thead>
            <tr>
                <th>Details<span class="help_icon" help_id="other_income_misc_details" ></span></th>
                <th>Date of Receipt</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody data-bind="foreach: miscIncomes">
            <tr>
                <td><input type="text" data-bind="attr: {name: '<?php echo $np ?>[details]'},value: details" /></td>
                <td>
                    <div data-bind="jqxDateTimeInput: {value: date, min: <?php echo $date_min ?>, max: <?php echo $date_max ?>, disabled: false, height: '25px', width: '134px' }" ></div>                                
                    <input type="hidden" data-bind="attr: {name: '<?php echo $np ?>[date_rcvd]'},value: date" />
                </td>
                <td>
                    <input type="text" autocomplete="off" class="number_input" data-bind="attr: {'onkeypress': 'return isNumber(event);', 'onkeyup': 'enableTooltip(this);', name: '<?php echo $np ?>[amount]'},value: amount" />
                    <input type="hidden" data-bind="attr: {name: '<?php echo $np ?>[id]'}, value: id" />
                    <input type="hidden" data-bind="attr: {name: '<?php echo $np ?>[category_id]'}" value="5" />
                </td>                
            </tr>
        </tbody>
    </table>
</div>
