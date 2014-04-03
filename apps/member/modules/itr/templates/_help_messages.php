<?php

$help_messages = array
                (
                    "sale_of_house_property"=>array("Income from Sale of House Property", "<span class='question'>What does 'immovable' property include ?</span><span class='answer'>Immovable property includes Residential / Commercial property that you may have sold.</span>"),
                    "share_investments"=>array("",""),
                    "shares_listed"=>array("Shares (Listed)","<span class='answer'>\"Shares Listed\" include Shares which are listed in any of recognized stock exchanges and Securities Transaction Tax(STT) was paid for the transaction. You need to add details of each transaction lot wise or for every sale separately. You can add transactions by clicking [Add Row] button.</span>"),
                    "shares_unlisted"=>array("",""),
                    "mutual_funds"=>array("",""),
                    "other_securities"=>array("",""),
                    "bonds_listed"=>array("",""),
                    "bonds_unlisted"=>array("",""),
                    "other_assets"=>array("",""),
                    "bank_ac"=>array("Bank Account Number","<span class='question'>Why do I need to provide a bank account number ?</span><span class='answer'>A bank account number is required specifically for the purpose of processing your income tax refund. Refund, if any, will be credited to this bank account</span><span class='question'>I have more than one NRO accounts, which one do I provide ?</span><span class='answer'>You can provide any one NRO bank account number.</span>"),
                    "ifsc_micr"=>array("IFSC / MICR Code","<span class='question'>Where do I find these ?</span><span class='answer'>You can find the IFSC and MICR codes of your bank on your cheque book. You can also click the links <a href='http://bankifsccode.com/' target='_blank'>Find MICR / IFSC Code</a> to locate your bank's IFSC / MICR Code</span>"),
                    "property_address"=>array("House Property: Address","<span class='answer'>Please enter the approximate address of the property. Locality, city and state are important. Pin Code ,if available, is very helpful as well.</span>"),
                    "property_tenant"=>array("Tenant Information","<span class='question'>I have more than one tenants, what do I do?</span><span class='answer'>You can enter the name of any one tenant. You will be required to enter the PAN card no. of that tenant</span>"),
                    "property_tenant_pan"=>array("Tenant PAN Information","<span class='question'>Do I need to enter PAN no. of all tenants?</span><span class='answer'>You can mention any one tenant and enter his/her PAN No.</span>"),    
                    "property_rent_received"=>array("Rent Received / Receivable","<span class='answer'>Total amount of rent you received during the financial year, this includes amount which is receivable as well.<br /><br /> You can specify the status of the rent for a particular month. <br /><br /> <b>Received</b>: You have recieved the rent for that month. <br /><b>To Be Received</b>: The rent has not been received yet but will be received. <br /><b>Vacant / Not Let Out:</b> If the house property has been empty, not let out for the entire month.<br /><b>Can not be Received</b>: If you think the amount of rent is not receivable from the tenant due to dispute or tenant has left out or any other reason for which rent is not receiveble.</span>"),
                    "property_rent_forgone"=>array("The amount of rent which cannot be realized","<span class='answer'>Amount of rent you could not realize due to some dispute with the tenant etc.</span>"),
                    "property_taxes_paid"=>array("Taxes Paid","<span class='answer'>Taxes paid to the municipal corporation</span>"),
                    "property_cost"=>array("Cost of the Property","Cost of the property as per the sale deed."),
                    "property_loan_repaid"=>array("Loan Repaid","<span class='answer'>The principle amount (NOT INTEREST) repaid during the year. You can get this information from your loan account statement.</span>"),
                    "property_int_paid"=>array("Interest Paid","<span class='answer'>The total interest paid during the financial year. You can get this information from your loan account statement.</span>"),
                    "property_loan_outstanding"=>array("Loan Outstanding","<span class='answer'>The total principle (Excluding Interest) amount of the loan oustanding. You can get this information from your loan account statement.</span>"),
                    "property_prev_year_rent"=>array("",""),
                    "property"=>array("",""),
                    "capital_other_sources"=>array("Capital Gains from Other Sources","<span class='answer'>Capital gains earned through selling of Shares, Mutual Funds, Bonds or any other asset not including any immoval poperty you may have sold.</span>"),
                    "capital_gains_statement"=>array("Capital Gains Statement","<span class='question'>What is a Capital Gains Statement ?</span><span class='answer'>A capital gains statement is a document detailing your capital gains liability for the financial year accured through selling of Shares, Mututal Fund Units and other securities.</span><span class='question'>Where do I get this statement ?</span><span class='answer'>Please contact your broker to avail this statement.</span><span class='question'>What kind of files can I upload?</span><span class='answer'>You can upload MS-Word (doc,docx), Excel (xls, xlsx) and PDF file statements.</span>"),
                    "capital_property_details"=>array("Property Sold: Address","<span class='answer'>Address has to be the address of property sold, exact address is not necessary. locality, City, state, country is needed.</span>"),
                    "capital_property_date_sale"=>array("Date of Sale","<span class='answer'>Date of sale from the Sale Deed of the Property.</span>"),
                    "capital_property_sale_value"=>array("Sale Value","<span class='answer'>The amount your have received / are entitled to receive as a result of selling this property. </span>"),
                    "capital_property_other_exp"=>array("","<span class='answer'> If any expenses done for selling the property, such as advertisement, Brokerage, stamp duty, registration fees, & Legal expenses etc. which is done only for selling the property.</span>"),
                    "capital_property_purchase"=>array("",""),
                    "capital_property_purchase_date"=>array("",""),
                    "capital_property_purchase_cost"=>array("Cost of Aquisition","<span>Cost of acquisition is the price which is paid or the amount which has incurred for acquiring the property/Assets. The expenses incurred at the time of completing the title are a part of cost of acquisition.</span>"),
                    "capital_property_addon_costs"=>array("Major cost of Improvement Done (Renovation / Additional Construction etc)","<span class='question'>What Expenses are covered under this head ?</span><span class='answer'> Any major expenditure is done for improvement or addition is done to the property, then it is added to the cost of property. general expenses such as painting, repairing, etc. for maintainence of property are not considered as major cost of improvement</span>

<span class='question'>
I do not have exact date of renovations, what should I enter in the date column ?
</span>
<span class='answer'>
While you can provide an approximate date (day and month), you should be certain of the year of the renovation / additional construction, as we need that information for indexation calculation.
</span>

<span class='question'>
Do I need to provide documentation supporting the costs I enter towards renovation / additional construction ?
</span>
<span class='answer'>
You should have with you the documentation (receipts, payment information like cheque nos) supporting the costs you enter. We do not need to present these at the time of filing returns, however, you might be asked for the same by the Income Tax Department at their own discretion.
</span>"),
"capital_1_details"=>array("Details of Shares","<span class='answer'>Name of the Security / Company (Stock Code)</span>"),    
"capital_2_details"=>array("Details of Shares","<span class='answer'>Name of the Security / Company (Stock Code)</span>"),        
"capital_6_details"=>array("Details of Mutual Fund Scheme","<span class='answer'>Name of the Scheme, Fund house</span>"),            
"capital_3_details"=>array("Details of Debentures / Bonds","<span class='answer'>Name of the Scheme / Security</span>"),            
"capital_4_details"=>array("Details of Debentures / Bonds","<span class='answer'>Name of the Scheme / Security</span>"),                
"capital_5_details"=>array("Details of Items Sold","<span class='answer'>Name of the asset sold</span>"),                    
"capital_1_purchase"=>array("Shares: Purchase Information","<span class='question'>What do I enter here ?</span><span class='answer'>In order to calculate your capital gains tax liability, we need to know when were the shares purchased. Please note that if the shares were purchased in parts at different dates and costs, you need to provide details of each purchase separetly. Please use the [Add Row] button to add more transactions.</span>"),
"capital_2_purchase"=>array("Shares: Purchase Information","<span class='question'>What do I enter here ?</span><span class='answer'>In order to calculate your capital gains tax liability, we need to know when were the shares purchased. Please note that if the shares were purchased in parts at different dates and costs, you need to provide details of each purchase separetly. Please use the [Add Row] button to add more transactions.</span>"),
"capital_6_purchase"=>array("Mutual Funds: Purchase Information","<span class='question'>What do I enter here ?</span><span class='answer'>In order to calculate your capital gains tax liability, we need to know when were the mutual fund units purchased. Please note that if the units were purchased in parts at different dates and costs, you need to provide details of each purchase separetly. Please use the [Add Row] button to add more transactions.</span>"),    
"capital_4_purchase"=>array("Debentures / Bonds: Purchase Information","<span class='question'>What do I enter here ?</span><span class='answer'>In order to calculate your capital gains tax liability, we need to know when were the units purchased. Please note that if the units were purchased in parts at different dates and costs, you need to provide details of each purchase separetly. Please use the [Add Row] button to add more transactions.</span>"),        
"capital_5_purchase"=>array("Other Assets Purchase Information","<span class='question'>What do I enter here ?</span><span class='answer'>In order to calculate your capital gains tax liability, we need to know the purchase date of the asset sold. Please note that if the assets were purchased in parts at different dates and costs, you need to provide details of each purchase separetly. Please use the [Add Row] button to add more transactions.</span>"),            
"capital_3_purchase"=>array("Debentures / Bonds: Purchase Information","<span class='question'>What do I enter here ?</span><span class='answer'>In order to calculate your capital gains tax liability, we need to know when were the units purchased. </span>"),            
"other_income_divident_details"=>array("","<span class='answer'>Name of the Scheme, Security etc.</span>"),
"other_income_int_details"=>array("","<span class='answer'>Name of the Scheme, Security etc.</span>"),
"other_income_rent_details"=>array("Rent Received from other than House property ","<span class='answer'>Brief Description</span>"),
"other_income_gift_details"=>array("Gifts Received: Details","<span class='answer'>Brief Description, from, occassion etc.</span>"),
"other_income_misc_details"=>array("","<span class='answer'>Brief description of the source.</span>"),    
    
                );
?>
<div id='help_messages' style='display: none;'>
    <?php foreach($help_messages as $key=>$msg):?>
    <div id='help_<?php echo $key ?>' title='<?php echo $msg[0] ?>'>
        <?php echo $msg[1];?>
    </div>
    <?php endforeach;?>
</div>