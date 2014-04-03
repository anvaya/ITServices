<?php
       $period = '01/04/'.($fy)." To 31/03/".($fy+1);
?>
<div id="page2" data-bind = "visible: currentPage() == 2">        
        <br />
	<h3 style='display: inline-block'>Details of House Property In India</h3>

        Any Individual holding House Property in India will be subject to Income under the head Income from House Property.
        <br /><br />
        Types of House Property<br />
a) Letout Property - If any House Property is letout(Rented) for any period (i.e. even for single day), it is considered as Letout Property.<br />
b) Deemed letout property - If any property is not letout for any period, during the year, then it is considered as deemed letout property. <br />
<br />

For calculation of Income Under the Head Income from House Property, both, Letout and Deemed letout property are considered.
<br />
Kindly enter the details individually for all the property held by you.
    <br /><br />
     
	<div style='display: inline-block'>
            <button data-bind="text: (properties().length > 0?'Add Another Property':'Add Property')" class="purple-btn" title="Click here to add one or more properties." onclick="myViewModel.addProperty(); return false;">
                Add Property
            </button>
        </div>

        <span class="help_icon" help_id="property" style="display: none;"></span>
        
	<div data-bind="foreach: properties, visible: properties().length > 0" id="properties">
		<table data-bind="attr: {id: 'properties' + $index()}" cellspacing="0" style="margin-top: 20px">
			<thead>
				<tr>
					<th>#</th>
                                        <th>Address of Property<span class="help_icon" data-bind="attr: {'onclick':'showHelp(this);'}" help_id="property_address"></span></th>
                                        <th>Locality</th>
					<th>Town/City</th>
					<th>State</th>
					<th>PIN Code</th>
                                        <th>Details</th>
				</tr>
			</thead>
			<tbody>
				<tr class="property_main_details">
					<td data-bind="text: $index() + 1"></td>
					<td><input type="text" data-bind="attr: { name: 'itr_submission[properties]['+$index()+'][address]' }, value: address" /></td>
                                        <td><input type="text" data-bind="attr: { name: 'itr_submission[properties]['+$index()+'][locality]' }, value: locality" /></td>
                                        <td><input type="text" data-bind="attr: { name: 'itr_submission[properties]['+$index()+'][city]' },value: city" /></td>
					<td>
						<select data-bind="attr: { name: 'itr_submission[properties]['+$index()+'][state]'},value: state">
							<option value="" selected="selected">--Select--</option>
                                                        <option value="1">Andaman &amp; Nicobar Islands</option>
                                                        <option value="2">Andhra Pradesh</option>
                                                        <option value="3">Arunachal Pradesh</option>
                                                        <option value="4">Assam</option>
                                                        <option value="5">Bihar</option>
                                                        <option value="6">Chandigarh</option>
                                                        <option value="33">Chhattisgarh</option>
                                                        <option value="7">Dadra &amp; Nagar Haveli</option>
                                                        <option value="8">Daman &amp; Diu</option>
                                                        <option value="9">Delhi</option>
                                                        <option value="10">Goa</option>
                                                        <option value="11">Gujarat</option>
                                                        <option value="12">Haryana</option>
                                                        <option value="13">Himachal Pradesh</option>
                                                        <option value="14">Jammu &amp; Kashmir</option>
                                                        <option value="35">Jharkhand</option>
                                                        <option value="15">Karnataka</option>
                                                        <option value="16">Kerala</option>
                                                        <option value="17">Lakhswadeep</option>
                                                        <option value="18">Madhya Pradesh</option>
                                                        <option value="19">Maharashtra</option>
                                                        <option value="20">Manipur</option>
                                                        <option value="21">Meghalaya</option>
                                                        <option value="22">Mizoram</option>
                                                        <option value="23">Nagaland</option>
                                                        <option value="24">Orissa</option>
                                                        <option value="25">Pondicherry</option>
                                                        <option value="26">Punjab</option>
                                                        <option value="27">Rajasthan</option>
                                                        <option value="28">Sikkim</option>
                                                        <option value="29">Tamil Nadu</option>
                                                        <option value="30">Tripura</option>
                                                        <option value="31">Uttar Pradesh</option>
                                                        <option value="32">West Bengal</option>
                                                        <option value="34">Uttaranchal</option> 
						</select>
					</td>
					<td>
						<input type="text" data-bind="attr: { name: 'itr_submission[properties]['+$index()+'][pin]'},value: pincode" />
					</td>
                                        <td>
                                            <a href="#" title="Click to Show / Hide details." data-bind="click: toggleDetails, text: detailsLabel"></a>
                                        </td>
				</tr>
				<tr data-bind="visible: detailsVisible()=='1'">	
					<td colspan="7">
					<div class="property_details">
						<div>
							<label data-bind="attr: {'for': 'coowned_' + $index()}">Is the Property co-owned ?</label>
							<div class="content2"><select data-bind="value: coowned, attr: {name: 'itr_submission[properties]['+$index()+'][co_owned]',  id: 'coowned_' + $index()}"><option value="0">No</option><option value="1">Yes</option></select></div>
						</div>

						<!-- ko template: {'if': coowned() == '1'} -->						
						<div>
							<label data-bind="attr: {'for': 'owner_share_' + $index()}">Your Percentage of share in Property</label>
							<div class="content2">
                                                         
                                                            <input type="text" data-bind="value: percentage,  attr: {name: 'itr_submission[properties]['+$index()+'][percent_share]', id: 'owner_share_' + $index()}" />
                                                        </div>
						</div>
						
						<fieldset>
						<legend>Details of Coowners:</legend>
						<div>
							<button class="purple-btn" data-bind="click: function(data, event) { myViewModel.addOwner($index()); return false;}">Add co-owner</button>
						</div>
						<table cellspacing="0" class="coowners">
							<thead>
								<tr>
									<th>S.No.</th>
									<th>Name of Co-owner</th>
									<th>PAN of Co-owner</th>
									<th>Percentage Share in Property</th>
								</tr>
							</thead>
							<tbody data-bind="foreach: coowners">
								<tr>
									<td data-bind="text: $index() + 1"></td>
									<td><input data-bind="attr: {name: 'itr_submission[properties]['+$parent.itemIndex()+'][owners][' + $index() +'][name]'},value: name" /></td>
									<td><input data-bind="attr: {name: 'itr_submission[properties]['+$parent.itemIndex()+'][owners][' + $index() +'][pan_no]'},value: pan_no" /></td>
									<td>
                                                                            <input type="text" autocomplete="off" class="number_input" maxlength="3" data-bind="attr: {'onkeypress': 'return isNumber(event);', 'onkeyup': 'enableTooltip(this);',name: 'itr_submission[properties]['+$parent.itemIndex()+'][owners][' + $index() +'][percentage]'},value: percentage" />                                                                            
                                                                        </td>
								</tr>
							</tbody>
						</table>
						</fieldset>
						
						<!-- /ko -->
						
						<div style="margin-top: 5px;">	
							<label data-bind="attr: {'for': 'let_out_' + $index() }">Is the Property Let Out ?</label>
							<div class="content2">
								<select data-bind="value: letout, attr: {name: 'itr_submission[properties]['+$index()+'][let_out]', id: 'let_out_' + $index()}">									
									<option value="0">No</option>
                                                                        <option value="1">Yes</option>
								</select>			
							</div>
						</div>
						
						<!-- ko template {'if': letout() == '1'} -->
						<fieldset>
						<legend>Rental Information (<?php echo $period ?>)</legend>
						<div>	
							<label data-bind="attr: {'for': 'tenant_' + $index() }">Name of the Tenant</label>
							<div class="content2">
                                                            <input type="text" data-bind="value: tenant, attr: {name: 'itr_submission[properties]['+$index()+'][tenant]', id: 'tenant_' + $index() }" />
                                                            <span class="help_icon" data-bind="attr: {'onclick':'showHelp(this);'}" help_id="property_tenant" ></span>
                                                        </div>
						</div>

						<div>	
							<label data-bind="attr: {'for': 'tenant_pan' + $index() }">PAN of the Tenant</label>
							<div class="content2">
                                                            <input type="text" data-bind="value: tenant_pan, attr: {name: 'itr_submission[properties]['+$index()+'][tenant_pan]',id: 'tenant_pan' + $index() }" />
                                                            <span class="help_icon" data-bind="attr: {'onclick':'showHelp(this);'}" help_id="property_tenant_pan" ></span>
                                                        </div>
						</div>

                        <div style="margin-top: 5px;">	
							<label data-bind="attr: {'for': 'rent_rcvd' + $index() }">Total amount of rent received / receivable in the year:</label>
                                                        <span class="help_icon" data-bind="attr: {'onclick':'showHelp(this);'}" help_id="property_rent_received"></span>
                                                </div>
                                                
                                                <div style="margin-bottom: 5px;">                                                
                                                    <table>
                                                            <?php $months = array("Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec","Jan","Feb","Mar");?>
                                                            <thead>
                                                            <tr><th>Month</th><th>Rent Amount</th><th>Status</th></tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php  for($i=0; $i<12; $i++): ?>
                                                                    <tr>
                                                                            <th><?php echo $months[$i]." ".($i<9?($fy):($fy+1)); ?></th>
                                                                            <td><input data-bind="value: rent_info[<?php echo $i; ?>].amount, attr: {'onkeypress': 'return isNumber(event);', 'onkeyup': 'enableTooltip(this);',name: 'itr_submission[properties]['+$index()+'][rent_details][<?php echo $i ?>][amount]' }" type="text" size="8"></td>
                                                                            <td>
                                                                                    <select data-bind="value: rent_info[<?php echo $i; ?>].flag, attr: {'name': 'itr_submission[properties]['+$index()+'][rent_details][<?php echo $i ?>][flag]' }">
                                                                                            <option value="1">Received</option>
                                                                                            <option value="2">To be Received</option>
                                                                                            <option value="4">Vacant (Not Let Out)</option>
                                                                                            <option value="3">Can not be Received</option>
                                                                                    </select>
                                                                            </td>
                                                                    </tr>
                                                            <?php endfor;?>
                                                        </tbody>
                                                    </table>
                                                    <input type="hidden" class="number_input" autocomplete="off" data-bind="value: rent_rcvd, attr: {'onkeypress': 'return isNumber(event);', 'onkeyup': 'enableTooltip(this);',name: 'itr_submission[properties]['+$index()+'][rent_rcvd]', id: 'rent_rcvd' + $index() }" />
						</div>

						<div style="display: none">	
							<label data-bind="attr: {'for': 'rent_foregone' + $index() }">The amount of rent which cannot be realized</label>
							<div class="content2">                                                            
                                                            <input type="text" autocomplete="off" class="number_input" data-bind="value: rent_foregone, attr: {'onkeypress': 'return isNumber(event);', 'onkeyup': 'enableTooltip(this);',name: 'itr_submission[properties]['+$index()+'][rent_not_realized]', id: 'rent_foregone' + $index() }" />
                                                            <span class="help_icon" data-bind="attr: {'onclick':'showHelp(this);'}" help_id="property_rent_forgone"></span>
                                                        </div>
						</div>

						<div>	
							<label data-bind="attr: {'for': 'taxes_paid_' + $index() }">Tax paid to local authorities</label>
							<div class="content2">
                                                            <input type="text" autocomplete="off" class="number_input" data-bind="value: taxes_paid, attr: {'onkeypress': 'return isNumber(event);', 'onkeyup': 'enableTooltip(this);',name: 'itr_submission[properties]['+$index()+'][tax_paid]',id: 'taxes_paid_' + $index() }" />                                                            
                                                            <span class="help_icon" data-bind="attr: {'onclick':'showHelp(this);'}" help_id="property_taxes_paid" ></span>
                                                        </div>
						</div>
						</fieldset>
						<!-- /ko -->
                                                
                                                <br />
						<h3>If any Loan is taken for purchase of House property, then details of Loan as follows</h3>
                                                <br />
                                                
						<div>	
							<label data-bind="attr: {'for': 'cost' + $index() }">Cost of House Property</label>
							<div class="content2">
                                                            <input type="text" autocomplete="off" class="number_input" data-bind="value: cost, attr: {'onkeypress': 'return isNumber(event);', 'onkeyup': 'enableTooltip(this);',name: 'itr_submission[properties]['+$index()+'][property_cost]',id: 'cost' + $index() }" />                                                            
                                                            <span class="help_icon"  data-bind="attr: {'onclick':'showHelp(this);'}" help_id="property_cost" ></span>
                                                        </div>
						</div>

                                                        
                                                        
						<div>	
							<label data-bind="attr: {'for': 'loan_amt' + $index() }">Amount of Loan taken</label>
							<div class="content2">
                                                            <input type="text" autocomplete="off" class="number_input" data-bind="value: loan_amt, attr: {'onkeypress': 'return isNumber(event);', 'onkeyup': 'enableTooltip(this);',name: 'itr_submission[properties]['+$index()+'][loan_amount]', id: 'loan_amt' + $index() }" />
                                                        </div>
						</div>

						<!-- ko template: {'if': hasError("loan_amount") } -->	
                                                    <div class="error" data-bind="text: errors['loan_amount']">                                                        
                                                    </div>
                                                <!-- /ko -->
                                                        
                                                <div>	
							<label data-bind="attr: {'for': 'loan_repaid' + $index() }">Principle repaid during the year</label>
							<div class="content2">
                                                            <input type="text" autocomplete="off" class="number_input" data-bind="value: loan_repaid, attr: {'onkeypress': 'return isNumber(event);', 'onkeyup': 'enableTooltip(this);',name: 'itr_submission[properties]['+$index()+'][loan_repaid]',id: 'loan_repaid' + $index() }" />                                                            
                                                            <span class="help_icon" data-bind="attr: {'onclick':'showHelp(this);'}" help_id="property_loan_repaid" ></span>
                                                        </div>
						</div>
					
						<div>	
							<label data-bind="attr: {'for': 'int_paid' + $index() }">Interest paid during the year</label>
							<div class="content2">
                                                            <input type="text" autocomplete="off" class="number_input" data-bind="value: int_paid, attr: {'onkeypress': 'return isNumber(event);', 'onkeyup': 'enableTooltip(this);',name: 'itr_submission[properties]['+$index()+'][interest_paid]',id: 'int_paid' + $index() }" />                                                            
                                                            <span class="help_icon" data-bind="attr: {'onclick':'showHelp(this);'}" help_id="property_int_paid" ></span>
                                                        </div>
						</div>
						
						<div>	
							<label data-bind="attr: {'for': 'loan_outstanding' + $index() }">Balance loan out standing (Principle)</label>
							<div class="content2">
                                                            <input type="text" autocomplete="off" class="number_input" data-bind="value: loan_outstanding, attr: {'onkeypress': 'return isNumber(event);', 'onkeyup': 'enableTooltip(this);',name: 'itr_submission[properties]['+$index()+'][loan_oustanding]',id: 'loan_outstanding' + $index() }" />                                                            
                                                            <span class="help_icon" data-bind="attr: {'onclick':'showHelp(this);'}" help_id="property_loan_outstanding" ></span>
                                                        </div>
						</div>
						
                                                <br />
						<h3 style="display: none;">
                                                    If any rent of previous years received during the year, then details of rent received
                                                    <span class="help_icon" data-bind="attr: {'onclick':'showHelp(this);'}" help_id="property_prev_year_rent" ></span>
                                                </h3>
                                                
                                                
                                                <table style="display: none">
                                                    <thead>
                                                        <tr>
                                                            <th>Year</th>
                                                            <th>Amount</th>
                                                            <th>
                                                                <div>
                                                                    <button class="purple-btn" data-bind="click: function(data, event) { myViewModel.addPropertyRentReceipt($index()); return false;}">Add Year</button>
                                                                </div>
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody data-bind="foreach: prev_rent_received">
                                                        <tr>
                                                            <td>
                                                                <input type="text" data-bind="value: year, attr: {name: 'itr_submission[properties]['+$parent.itemIndex()+'][prev_year_receipt]['+$index()+'][year]', id: 'prev_rent_year' + $index() }" />                                                                
                                                            </td>
                                                            <td colspan="2">                                                                
                                                                <input type="hidden" autocomplete="off" class="number_input" data-bind="value: amount, attr: {'onkeypress': 'return isNumber(event);', 'onkeyup': 'enableTooltip(this);',name: 'itr_submission[properties]['+$parent.itemIndex()+'][prev_year_receipt]['+$index()+'][amount]',id: 'prev_rent_amt' + $index() }" />
                                                            </td>
                                                        </tr>    
                                                    </tbody>    
                                                </table>
                                                
					</div>	
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>