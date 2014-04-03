<?php
       $period = '01/04/'.($fy)." To 31/03/".($fy+1);
?><div id="page3" data-bind = "visible: currentPage() == 3">
    <h3>Details of Investments / Assets which are sold during the year (<?php echo $period ?>) </h3>
    <h4>(If Investments or any assets are sold during the year, it attracts Capital Gain.)</h4>
    <br />

    <div id='accordion' class="ui-accordion ui-widget ui-helper-reset">
        <div class="ui-corner-all" style="border: 1px solid #E48605; margin-bottom: 40px;" >
            <div class="ui-corner-all ui-widget-header" >
                <h3 style="padding-top: 5px; padding-bottom: 5px; padding-left: 5px;">
                    Capital Gains from Immovable Property
                    <span class="help_icon" help_id="sale_of_house_property"></span>
                </h3>                
            </div>


            <h4> Have you sold one or more immovable properties in the financial year ? If so, please provide details below.</h4>

            <div class="investent_head">

                <div class="investment_group">                

                    <div><button class="purple-btn" onclick="myViewModel.addCapitalItem(7); return false;">Add Property</button></div><br />                
                    <?php include_partial("_capital_group_property", array ('fy'=>$fy,'itemIndex'=>7, 'viewModelItem'=>'capitalItems7', 'sub_form_name'=>'capitals7','details_label'=>'Address','qty_label'=>'qty') );?>                
                    <div data-bind="visible: capitalItems7().length > 0">
                        <button class="purple-btn" onclick="myViewModel.addCapitalItem(7); return false;">                        
                            Add Another Property
                        </button>                    
                    </div><br />                
                </div>
            </div>
        </div>
        
         <div class="ui-corner-all ui-widget-header" >
            <h3 style="padding-top: 5px; padding-bottom: 5px; padding-left: 5px;">
                Capital Gains from Other Sources
                <span class="help_icon" help_id="capital_other_sources"></span>
            </h3>                
        </div>
        
        <br />  
        
        <div style="background-color: white; border: 1px solid #ccc; padding: 5px">
            <div style="background-color: #A0864D; color: white; padding-left: 2px; padding-bottom: 2px;">
                <h3>Capital Gains Statement
                    <span style="margin-top: 4px;" class="help_icon" help_id="capital_gains_statement"></span>
                </h3>
            </div>        
        
            <h4>Have you received a capital gains statement from your broker ? Upload it here.</h4>
            <p style="color: black; text-align: left">If you have carried out sale transactions of Shares, Mutual Funds, Debentures / Bonds or any other asset, we are required to calculate
                your capital gains tax liability. Many brokers provide a capital gains statement for the financial year, listing the capital gains earned through all
                your transactions carried out through the broker. If you have such a statement available from your broker, please upload it below.              
            </p>
            <?php include_partial("_capital_gains_files");?>
            <p style="color: black; text-align: left">
                <b>Please Note</b>: If you do not have such a statement, or have carried out transactions not included in the capital gains statement, kindly provide details of the same in the following sections.
                <br />You can get the required details of sale and purchase of share and mutual fund units from the statement of account for you share transaction.
            </p>
        </div><br />
        
        
        <h3 class="ui-accordion-header ui-helper-reset ui-state-hover ui-corner-all ui-accordion-icons">
            <span class="ui-accordion-header-icon ui-icon ui-icon-triangle-1-e"></span>
            1) Investments sold in Shares in India (If capital gains statement not uploaded OR for transactions not included in capital gains Statement)
            <span class="help_icon" style="display: none;" help_id="share_investments">
            </span>            
        </h3>        
        <div class="investent_head ui-corner-all" style="border: 1px solid #FBCB09; margin-bottom: 40px;" >
            <!--
            <h4>1) Investments in Shares in India</h4>
            -->
            <div class="investment_group">
                <h4>a) Shares (listed in stock Exchange)
                &nbsp;
                <span class="help_icon" help_id="shares_listed"></span>
                </h4>
                
                <div><button class="purple-btn" onclick="myViewModel.addCapitalItem(1); return false;">Add Row</button></div><br />
                
                <?php include_partial("_capital_group", array ('fy'=>$fy,'itemIndex'=>1, 'viewModelItem'=>'capitalItems', 'sub_form_name'=>'capitals1','details_label'=>'Details of Shares','qty_label'=>'No. of Shares') );?>


                <h4>b) Shares (unlisted) <span class="help_icon" style="display: none;" help_id="shares_unlisted"></span></h4>
                
                <div><button class="purple-btn" onclick="myViewModel.addCapitalItem(2); return false;">Add Row</button></div><br />
                
                <?php include_partial("_capital_group", array ('fy'=>$fy, 'itemIndex'=>2,'viewModelItem'=>'capitalItems2', 'sub_form_name'=>'capitals2','details_label'=>'Details of Shares','qty_label'=>'No. of Shares') );?>
            </div>
        </div>
        
        
        <h3 class="ui-accordion-header ui-helper-reset ui-state-hover ui-corner-all ui-accordion-icons">
            <span class="ui-accordion-header-icon ui-icon ui-icon-triangle-1-e"></span>
            2) Investments sold in Mutual Funds in India (If capital gains statement not uploaded OR for transactions not included in capital gains Statement)
            <span class="help_icon" style="display: none;" help_id="mututal_funds"></span>
        </h3>        
        <div class="investent_head ui-corner-all" style="border: 1px solid #FBCB09; margin-bottom: 40px;" >
        <!--<h4>2) Investments in Mutual Funds in India</h4>-->
            <br />
            <div class="investment_group">            
                <div><button class="purple-btn" onclick="myViewModel.addCapitalItem(6); return false;">Add Row</button></div><br />
                <?php include_partial("_capital_group", array ('fy'=>$fy,'itemIndex'=>6, 'viewModelItem'=>'capitalItems6', 'sub_form_name'=>'capitals6','details_label'=>'Details of Scheme','qty_label'=>'No. of Units') );?>            
            </div>
        </div>
        
        
        <h3 class="ui-accordion-header ui-helper-reset ui-state-hover ui-corner-all ui-accordion-icons">
            <span class="ui-accordion-header-icon ui-icon ui-icon-triangle-1-e"></span>
            3) Investments sold in other Securities (If capital gains statement not uploaded OR for transactions not included in capital gains Statement)
            <span class="help_icon" style="display: none;" help_id="other_securities"></span>
        </h3>        
        <div class="investent_head ui-corner-all" style="border: 1px solid #FBCB09; margin-bottom: 40px;" >
            <!-- <h4>3) Investments in other Securities</h4>-->

            <div class="investment_group">
                <h4>a) Debentures/ Bonds(Listed in Stock Exchange)                
                    <span class="help_icon" style="display: none;" help_id="bonds_listed"></span>
                </h4>
                <div><button class="purple-btn" onclick="myViewModel.addCapitalItem(3); return false;">Add Row</button></div><br />
                <?php include_partial("_capital_group", array ('fy'=>$fy,'itemIndex'=>3,'viewModelItem'=>'capitalItems3', 'sub_form_name'=>'capitals3','details_label'=>'Details of Bond','qty_label'=>'Quantity Sold') );?>

                <h4>b) Debentures/ Bonds(Unlisted)                    
                    <span class="help_icon" style="display: none;" help_id="bonds_unlisted"></span>
                </h4>
                <div><button class="purple-btn" onclick="myViewModel.addCapitalItem(4); return false;">Add Row</button></div><br />
                <?php include_partial("_capital_group", array ('fy'=>$fy,'itemIndex'=>4,'viewModelItem'=>'capitalItems4', 'sub_form_name'=>'capitals4','details_label'=>'Details of Bond','qty_label'=>'Quantity Sold') );?>
            </div>
        </div>

        <h3 class="ui-accordion-header ui-helper-reset ui-state-hover ui-corner-all ui-accordion-icons">
            <span class="ui-accordion-header-icon ui-icon ui-icon-triangle-1-e"></span>
            4) Any other assets sold during the year such as, land / motor /vehicles etc.
            <span class="help_icon" style="display: none;" help_id="other_assets"></span>
        </h3>
        <div class="investent_head ui-corner-all" style="border: 1px solid #FBCB09; margin-bottom: 40px;" >
            <!-- <h4>4) Any other assets sold during the year such as, House property / land / motor /vehicles etc.</h4>-->
            <br /> 
            <div class="investment_group">            
                <div><button class="purple-btn" onclick="myViewModel.addCapitalItem(5); return false;">Add Row</button></div><br />
                <?php include_partial("_capital_group", array ('fy'=>$fy,'itemIndex'=>5,'viewModelItem'=>'capitalItems5', 'sub_form_name'=>'capitals5','details_label'=>'Details of Item Sold','qty_label'=>'Quantity') );?>
            </div>
        </div>        
    </div>
</div>
<script type='text/javascript'>
    $('document').ready(function()
    {
       /*
        $('#accordion').accordion(
            { 
                header: "h3",
                collapsible: false,                
                navigation: true,
                heightStyle: "content"
            }); 
       */
    });
</script>