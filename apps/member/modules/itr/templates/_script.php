<?php

    /* @var $form itr_submissionForm */
    $record = $form->getObject();
    /* @var $record itr_submission */
    
    include(dirname(__FILE__)."/_help_messages.php");
    
    function jqxDate($date)
    {        
        if(strlen($date)==0)
        {
            return '""';
        }
        
        if(strpos($date,'/')>0)
        {
            $date_parts = explode("/", $date);
            if(count($date_parts)>2 && is_numeric($date_parts[2]) && is_numeric($date_parts[1]) && is_numeric($date_parts[0]) )
            {
                return  "new Date(".$date_parts[2].",".($date_parts[1]-1).",".(intval($date_parts[0])).")";
            }
            else
            {
                return  "new Date()";
            }
        }
        else
        {
            $date_parts = explode("-", $date);
            if(count($date_parts)>2 && is_numeric($date_parts[2]) && is_numeric($date_parts[1]) && is_numeric($date_parts[0]) )
            {
                return  "new Date(".$date_parts[0].",".($date_parts[1]-1).",".(intval($date_parts[2])).")";
            }
            else
            {
                try
                {
                    $dateObj =  new DateTime(trim(preg_replace('/\(.*\)/', "", $date)));                               
                    return sprintf('new Date(%d,%d,%d)', $dateObj->format('Y'), $dateObj->format('m')-1,$dateObj->format('d'));                
                }catch(Exception $ex)
                {
                    return 'new Date()';
                }
                
            }
        }
       //return '"'.$date_parts[2]."/".$date_parts[1]."/".$date_parts[0].'"';
        
    }
?><script type="text/javascript">
        
    var current_page = 0;

    function changePage(byValue)
    {
        try
        {            
            current_page = myViewModel.currentPage();
            
            if(byValue >= 0)
            {
                if(current_page == 6)
                        return;

                current_page++;
            }
            else
            {
                if(current_page == 0)
                        return;

                current_page--;
            }

            myViewModel.currentPage(current_page);            
            window.scrollTo(0,0);    
        }catch(e)
        {
            alert(e.message);
        }
        
        return false;
    }


 function changeToPage(page_num)
    {
        try
        {                       
            myViewModel.currentPage(page_num);            
            window.scrollTo(0,0);    
        }catch(e)
        {
            alert(e.message);
        }
        
        return false;
    }
    
    function coOwner(name, pan_no, percentage)
    {
        var self = this;
        self.name = name;
        self.pan_no = pan_no;
        self.percentage = ko.observable(percentage);
    }

    function Rent(year, amount)
    {
        var self = this;
        self.year = year;
        self.amount = ko.observable(amount);
    }  

    function Exemption(label, category_id, amount, id)
    {
        var self = this;
        self.amount = ko.observable(amount);
        self.category_id = category_id;
        self.label = label;
        self.id = id;
    }

    function itrFile(filename, remove_flag, error, id)
    {
        var self = this;
        self.filename = ko.observable(filename);
        self.remove_flag = ko.observable(remove_flag);
        self.error = error;
        self.id = id;
    }

    function PropertyInfo(address, city, state, pincode, coowned, coowners, percentage,  letout, tenant, tenant_pan, rent_foregone, taxes_paid, cost, loan_amt, loan_repaid, int_paid, loan_outstanding, prev_rent_received, rent_rcvd, errors, locality,rent_info)
    {
        var self = this;
        self.address = address;
        self.city	 = city;
        this.state = state;
        self.pincode = pincode;
        self.coowned = ko.observable(coowned);
        self.coowners = ko.observableArray(coowners);
        self.percentage = ko.observable(percentage);
        self.letout = ko.observable(letout);
        self.tenant = tenant;
        self.tenant_pan = tenant_pan;
        self.rent_foregone = ko.observable(rent_foregone);
        self.taxes_paid = ko.observable(taxes_paid);
        self.cost = ko.observable(cost);
        self.loan_amt = ko.observable(loan_amt);
        self.loan_repaid = ko.observable(loan_repaid);
        self.int_paid = ko.observable(int_paid);
        self.loan_outstanding = ko.observable(loan_outstanding);
        self.prev_rent_received = ko.observableArray(prev_rent_received);
        self.rent_rcvd = ko.observable(rent_rcvd);
        self.errors = errors;
        self.locality = locality;
        
        
        self.hasAnyError = function()
        {
            for(var key in self.errors)
            {
                return true;
            }
            
            return false;
        };
     
        
        
        if(rent_info.length < 12)
        {
            self.rent_info = ["","","","", "","","","", "","","",""];
        }
        else
        {
            self.rent_info = rent_info;
        }
        
        details_visible = 0;
        
        if(self.hasAnyError() || address.length == 0)
        {
            details_visible = 1;            
        }        
        
        self.detailsVisible = ko.observable(details_visible);            
        
        self.toggleDetails = function()
        {                       
            if(self.detailsVisible()===1)
            {
                self.detailsVisible(0);
            }
            else
            {
                self.detailsVisible(1);
            }
        };        
        
        self.detailsLabel = ko.computed(function()
        {
            return (self.detailsVisible()===0?'Show':'Hide');
        });
        
        self.addOwner = function()
        {
            self.coowners.push(new coOwner("", "", ""));
        };
        
        self.itemIndex = function()
        {
            return myViewModel.properties.indexOf(self);
        };
        
        self.addPrevYearRentRow = function()
        {
            self.prev_rent_received.push(new Rent("","") );
        };            
        
        self.hasError = function(field_key)
        {            
            for(var key in self.errors)
            {                         
                if(key===field_key)
                {                                 
                     return true;
                }
            }
            
            return false;
        };
        
       
    }

    function sharePurchase(date, quantity, cost)
    {
        var self = this;
        if(date.length == 0)
        {
            self.date = ko.observable(new Date());            
        }
        else
            self.date = ko.observable(date);
        
        self.quantity = ko.observable(quantity);
        self.cost     = ko.observable(cost);
        self.remove_flag = ko.observable(0);
    }

    function RentReceipt(amount, flag)
    {
        var self = this;
        self.amount = amount;
        self.flag   = flag;
    }
    

    function CapitalItem(type, name, date_sold, qty, sell_value, brokerage, other_charges, purchase_info, id, errors, addon_costs, addon_expenses )
    {
        var self = this;

        self.type = type;        
        
        self.date_sold = ko.observable(date_sold);
        
        self.name = ko.observable(name);        
        self.qty = ko.observable(qty);        
        self.sell_value = ko.observable(sell_value);
        self.brokerage = ko.observable(brokerage);
        self.other_charges = ko.observable(other_charges);       
        self.remove_flag      = ko.observable(0);        
        self.purchaseInfo = ko.observableArray(purchase_info);
        self.addonCosts = ko.observableArray(addon_costs);
        self.addonExpenses = ko.observableArray(addon_expenses);
        
        self.id = id;
        self.errors = errors;
        
        self.itemIndex = function()
        {
            switch(self.type)
            {
                case 1:
                    return myViewModel.capitalItems.indexOf(self);
                    break;
                case 2:
                    return myViewModel.capitalItems2.indexOf(self);
                    break;
                case 3:
                    return myViewModel.capitalItems3.indexOf(self);
                    break;
                case 4:
                    return myViewModel.capitalItems4.indexOf(self);
                    break;
                case 5:
                    return myViewModel.capitalItems5.indexOf(self);
                    break;
                case 6:
                    return myViewModel.capitalItems6.indexOf(self);
                    break;    
                case 7:
                    return myViewModel.capitalItems7.indexOf(self);
                    break;
            }
        };
        
        self.addPurchaseRow = function()
        {
            self.purchaseInfo.push(new sharePurchase("","","") );
        };
        
        self.addCostsRow = function()
        {
            self.addonCosts.push(new Income("","","","") );
        };
        
        self.addExpenseRow = function()
        {
            self.addonExpenses.push(new Income("","","",""));
        };
        
        self.hasError = function(field_key)
        {
            for(var key in self.errors)
            {
                if(key===field_key)
                {
                     return true;
                }
            }
            
            return false;
        };
        
        self.hasAnyError = function()
        {
            for(var key in self.errors)
            {
                return true;
            }
            
            return false;
        };
        
        if(name.length > 0 && !self.hasAnyError())
        {
            self.detailsVisible = ko.observable(0);        
        }
        else
        {            
            self.detailsVisible = ko.observable(1);                
        }
        
        self.toggleDetails = function()
        {                       
            if(self.detailsVisible()===1)
            {
                self.detailsVisible(0);
            }
            else
            {
                self.detailsVisible(1);
            }
        };                     
    }

    function Income(date, amount, id, details)
    {
        var self = this;
        self.details = details;
        if(date.length == 0)
        {
            self.date = ko.observable(new Date());
        }
        else
        {
            self.date = ko.observable(date);
        }
        
        self.amount = ko.observable(amount);
        self.id = id;
    }

    function ITRViewModel()
    {
        
        var properties_list = Array();
        <?php foreach($form['properties'] as $index=>$pr): ?>
                
                address    = "<?php echo $pr['address']->getValue();?>";
                city       = "<?php echo $pr['city']->getValue();?>";
                state      = "<?php echo $pr['state']->getValue();?>";
                pincode    = "<?php echo $pr['pin']->getValue();?>";
                coowned    = "<?php echo $pr['co_owned']->getValue();?>";                
                    
                <?php 
                        $owners = $pr['owners']->getValue();
                        if(!is_array($owners))
                        {                   
                            if(strlen($owners))
                            {
                                $owners = json_decode($owners, true);                                
                            }
                            else
                            {
                                $owners = array();
                            }
                        }                        
                ?>                
                coowners   = Array();
                
                <?php foreach($owners as $key=>$owner):?>
                    coowners[<?php echo $key ?>] = new coOwner("<?php echo $owner['name'] ?>","<?php echo $owner['pan_no'] ?>","<?php echo $owner['percentage'] ?>");
                <?php endforeach;?>
                
                percentage = "<?php echo $pr['percent_share']->getValue();?>";
                letout     = "<?php echo $pr['let_out']->getValue();?>";
                tenant    = "<?php echo $pr['tenant']->getValue();?>";
                tenant_pan = "<?php echo $pr['tenant_pan']->getValue();?>";
                rent_foregone = "<?php echo $pr['rent_not_realized']->getValue();?>";
                taxes_paid  = "<?php echo $pr['tax_paid']->getValue();?>";
                cost        = "<?php echo $pr['property_cost']->getValue();?>";
                loan_amt    = "<?php echo $pr['loan_amount']->getValue();?>";
                loan_repaid = "<?php echo $pr['loan_repaid']->getValue();?>";
                int_paid           = "<?php echo $pr['interest_paid']->getValue();?>";
                loan_outstanding   = "<?php echo $pr['loan_oustanding']->getValue();?>";
                rent_rcvd       = "<?php echo $pr['rent_rcvd']->getValue();?>";
                rent_info       = Array();
                prev_rent_received = Array();
                locality = "<?php echo $pr['locality']->getValue(); ?>";
                
                <?php
                       $prev_years = $pr['prev_year_receipt']->getValue();
                       if(!is_array($prev_years) )
                       {                         
                           if(strlen($prev_years))
                           {
                             $prev_years = json_decode($prev_years, true);
                           }
                           else
                           {
                             $prev_years = array();       
                           }
                       }
                       
                       if(!is_array($prev_years))
                       {
                           $prev_years = array();
                       }
                ?>   
                                     
                <?php foreach($prev_years as $key=>$prev_year):?>
                    prev_rent_received[<?php echo $key ?>] = new Rent("<?php echo $prev_year['year'] ?>","<?php echo $prev_year['amount'] ?>");
                <?php endforeach;?>
                    
                <?php
                       $rent_info_raw = $pr['rent_details']->getValue();
                       if(!is_array($rent_info_raw) )
                       {                         
                           if(strlen($rent_info_raw))
                           {
                             $rent_info_raw = json_decode($rent_info_raw, true);
                           }
                           else
                           {
                             $rent_info_raw = array
                                 ( 
                                    array("amount"=>"","flag"=>""),
                                    array("amount"=>"","flag"=>""),
                                    array("amount"=>"","flag"=>""),                                    
                                    array("amount"=>"","flag"=>""),
                                    array("amount"=>"","flag"=>""),
                                    array("amount"=>"","flag"=>""),
                                    array("amount"=>"","flag"=>""),
                                    array("amount"=>"","flag"=>""),
                                    array("amount"=>"","flag"=>""),
                                    array("amount"=>"","flag"=>""),
                                    array("amount"=>"","flag"=>""),
                                    array("amount"=>"","flag"=>""),
                                 );       
                           }
                       }
                       
                       if(!is_array($rent_info_raw))
                       {
                           $rent_info_raw = array
                                 ( 
                                    array("amount"=>"","flag"=>""),
                                    array("amount"=>"","flag"=>""),
                                    array("amount"=>"","flag"=>""),                                    
                                    array("amount"=>"","flag"=>""),
                                    array("amount"=>"","flag"=>""),
                                    array("amount"=>"","flag"=>""),
                                    array("amount"=>"","flag"=>""),
                                    array("amount"=>"","flag"=>""),
                                    array("amount"=>"","flag"=>""),
                                    array("amount"=>"","flag"=>""),
                                    array("amount"=>"","flag"=>""),
                                    array("amount"=>"","flag"=>""),
                                 );       
                       }
                ?>                                                       
                                                    
                                                    
                <?php foreach($rent_info_raw as $key=>$rent_info):?>
                    rent_info[<?php echo $key ?>] = new RentReceipt("<?php echo $rent_info["amount"] ?>","<?php  echo $rent_info["flag"] ?>");
                <?php endforeach;?>
                
                errors = Array();
                
                <?php $check_fields = array("loan_amount"); ?>
                <?php foreach($check_fields as $idx=>$fld):?>
                    <?php if($pr[$fld]->hasError()):?>
                            errors["<?php echo $fld ?>"] = "<?php echo str_replace("]","", str_replace($fld." [","", $pr[$fld]->getError()->getMessage())); ?>";
                    <?php endif;?>    
                <?php endforeach;?>
                
                
                properties_list[<?php echo $index ?>] = new PropertyInfo(address, city, state, pincode,coowned, coowners, percentage,letout, tenant, tenant_pan, rent_foregone, taxes_paid, cost, loan_amt, loan_repaid,int_paid, loan_outstanding,prev_rent_received, rent_rcvd, errors, locality, rent_info);
        <?php endforeach;?>        
        
        <?php include_partial("capitals_list_script", array("form"=>$form,"index"=>7) );?>
        <?php include_partial("capitals_list_script", array("form"=>$form, "index"=>1) );?>
        <?php include_partial("capitals_list_script", array("form"=>$form,"index"=>2) );?>
        <?php include_partial("capitals_list_script", array("form"=>$form,"index"=>3) );?>
        <?php include_partial("capitals_list_script", array("form"=>$form,"index"=>4) );?>
        <?php include_partial("capitals_list_script", array("form"=>$form,"index"=>5) );?>
        <?php include_partial("capitals_list_script", array("form"=>$form,"index"=>6) );?>
        
        <?php include_partial("other_income_list_script", array("form"=>$form,"index"=>1) );?>
        <?php include_partial("other_income_list_script", array("form"=>$form,"index"=>2) );?>
        <?php include_partial("other_income_list_script", array("form"=>$form,"index"=>3) );?>
        <?php include_partial("other_income_list_script", array("form"=>$form,"index"=>4) );?>
        <?php include_partial("other_income_list_script", array("form"=>$form,"index"=>5) );?>
        
        var files = Array();
        <?php 
             foreach($form['itr_files'] as $k=>$cp):                
                $fl = $cp['filename'];                
        ?>                 
                <?php if($fl->hasError()): ?>                                 
                    error = "<?php echo str_replace("]","", str_replace('filename'." [","", $fl->getError()->getMessage())); ?>";
                <?php else:?>
                    error = "";
                <?php endif;?>    
                files[<?php echo $k ?>] = new itrFile("<?php echo $fl->getWidget()->getOption('file_src'); ?>",0, error, "<?php echo $cp['id']->getValue() ?>");
        <?php
             endforeach;
        ?>
        
        var self = this;        
        self.currentPage = ko.observable(0);
        self.properties = ko.observableArray(properties_list);
        self.capitalItems = ko.observableArray(capital_list_1);
        self.capitalItems2 = ko.observableArray(capital_list_2);
        self.capitalItems3 = ko.observableArray(capital_list_3);
        self.capitalItems4 = ko.observableArray(capital_list_4);
        self.capitalItems5 = ko.observableArray(capital_list_5);
        self.capitalItems6 = ko.observableArray(capital_list_6);
        self.capitalItems7 = ko.observableArray(capital_list_7);
        self.dividentIncomes = ko.observableArray(other_income_1);
        self.interestIncomes = ko.observableArray(other_income_2);
        self.rentIncomes = ko.observableArray(other_income_3);
        self.giftIncomes = ko.observableArray(other_income_4);
        self.miscIncomes = ko.observableArray(other_income_5);
        self.files       = ko.observableArray(files);
        
        var exemptions = Array();
        <?php foreach($form['exemptions'] as $k=>$exm):?>
            <?php $label = exemption_categoryTable::getInstance()
                                ->find($exm['category_id']->getValue());?>
            exemptions[<?php echo $k ?>] = new Exemption("<?php echo $label->getTypeName() ?>","<?php echo $exm['category_id']->getValue() ?>","<?php echo $exm['amount']->getValue(); ?>","<?php echo $exm['id']->getValue(); ?>");
        <?php endforeach;?>
            
        self.exemptions = ko.observableArray(exemptions);            

        self.addProperty = function()
        {
           try
           {                
                var properties = self.properties();
                for(i=0; i< properties.length; i++)
                {                      
                   properties[i].detailsVisible(0);
                }                
                self.properties.push(new PropertyInfo("", "", "", "", "N", Array(), 100, "N", "", "", "", "", "", "", "", "", "",  Array(),"", Array(),"", Array() ));
           }catch(e)
           {
               alert(e.message);
           }
        };

        self.addDivident = function()
        {
            self.dividentIncomes.push(new Income("","","",""));
        };

        self.addInterestIncome = function()
        {
            self.interestIncomes.push(new Income("","","",""));
        };

        self.addRentIncome = function()
        {
            self.rentIncomes.push(new Income("","","",""));
        };

        self.addGiftIncome = function()
        {
            self.giftIncomes.push(new Income("","","",""));
        };
        
        self.addMiscIncome = function()
        {
            self.miscIncomes.push(new Income("","","",""));
        };

        self.addOwner = function(index)
        {
                var details = self.properties();
                details[index].addOwner();
        };
        
        self.addPropertyRentReceipt = function(index)
        {
            var details = self.properties();
            details[index].addPrevYearRentRow();
        };

        self.addCostsRow = function(type, index)
        {
            capital_item = self.capitalItems7();   
            capital_item[index].addCostsRow();
        };

        self.addPurchaseInfoRow = function(type, index)
        {            
            try
            {                
                var capital_item = null;

                switch(type)
                {                    
                    case 1:
                        capital_item = self.capitalItems();        
                        break;
                    case 2:
                        capital_item = self.capitalItems2();        
                        break;
                    case 3:
                        capital_item =  self.capitalItems3();        
                        break;
                    case 4:
                        capital_item = self.capitalItems4();        
                        break;
                    case 5:
                        capital_item = self.capitalItems5();        
                        break;
                    case 6:                        
                        capital_item = self.capitalItems6();        
                        break;                    
                    case 7:                        
                        capital_item = self.capitalItems7();        
                        break;                        
                }

                capital_item[index].addPurchaseRow();
            }catch(e)
            {
                alert(index + ":" + e);
            }
            return false;
        };
        
        self.addCapitalItem = function(type)
        {    
            var purchase = new sharePurchase("","","");
            purchaseArray = new Array();
            purchaseArray[0] = purchase;
            
            costArray  = new Array();
            costArray[0] = new Income("","","","");
            
            try
            {
                switch(type)
                {
                    case 1:  
                        capital_item = self.capitalItems;
                        //self.capitalItems.push(new CapitalItem(type, "", "", "", "", "", "", purchaseArray,"", Array(), Array(), Array() ));        
                        break;
                    case 2:                        
                        capital_item = self.capitalItems2;
                        //self.capitalItems2.push(new CapitalItem(type, "", "", "", "", "", "", purchaseArray,"", Array(), Array(), Array() ));        
                        break;                        
                    case 3:   
                        capital_item = self.capitalItems3;
                        //self.capitalItems3.push(new CapitalItem(type, "", "", "", "", "", "", purchaseArray,"", Array(), Array(), Array() ));        
                        break;
                    case 4:           
                        capital_item = self.capitalItems4;
                        //self.capitalItems4.push(new CapitalItem(type, "", "", "", "", "", "", purchaseArray,"", Array(), Array(), Array() ));        
                        break;
                    case 5:
                        capital_item = self.capitalItems5;
                        //self.capitalItems5.push(new CapitalItem(type, "", "", "", "", "", "", purchaseArray,"", Array(), Array(), Array() ));        
                        break;
                    case 6:
                        capital_item = self.capitalItems6;
                        //self.capitalItems6.push(new CapitalItem(type, "", "", "", "", "", "", purchaseArray,"", Array(), Array(), Array() ));        
                        break;                    
                    case 7:
                        capital_item = self.capitalItems7;
                        //self.capitalItems7.push(new CapitalItem(type, "", "", "", "", "", "", purchaseArray,"", Array(), costArray, Array() ));        
                        break;                                            
                }
                
                var items = capital_item();
                for(i=0; i < items.length; i++)
                {
                    if(items[i].name().length > 0)
                    {
                        items[i].detailsVisible(0);
                    }
                }
                
                capital_item.push(new CapitalItem(type, "", new Date(), "", "", "", "", purchaseArray,"", Array(), costArray, Array() )); 
                
            }catch(e)
            {
                alert(e.message);
            }
        };
        
        self.hasErrors = function(page_id)
        {            
            try
            {
                switch(page_id)
                {
                    case 2:
                        var properties = self.properties();                    
                        return collectionHasErrors(properties);
                        break;
                    case 3:

                        hasError = collectionHasErrors(self.capitalItems());
                        if(hasError) return true;

                        hasError = collectionHasErrors(self.capitalItems2());
                        if(hasError) return true;

                        hasError = collectionHasErrors(self.capitalItems3());
                        if(hasError) return true;

                        hasError = collectionHasErrors(self.capitalItems4());
                        if(hasError) return true;

                        hasError = collectionHasErrors(self.capitalItems5());
                        if(hasError) return true;                                                            

                        collection = self.files();
                        for(i=0; i<collection.length; i++)
                        {     
                              error = collection[i].error;
                              if(error.length > 0)
                                  return true;
                        }                   

                        break;

                }
            }catch(ex)
            {
                
            }
            return false;
        };       
     
        self.caller = function()
        {
            alert('hi');
        };
    }

    function collectionHasErrors(collection)
    {
        for(i=0; i<collection.length; i++)
        {     
            errors = collection[i].errors;
            for(var key in errors)
            {                           
                if(key !== 'indexOf')
                {                    
                    return true;
                }
            }            
        }
        return false;
    }
    
    (function($) {

    $.fn.extend({
        limiter: function(limit, elem) {
            $(this).on("keyup focus", function() {

                setCount(this, elem);

            });

            function setCount(src, elem) {

                var chars = src.value.length;

                if (chars > limit) {

                    src.value = src.value.substr(0, limit);

                    chars = limit;

                }
                elem.html('Characters Left: ' + (limit - chars) );
            }
            setCount($(this)[0], elem);
        }

    });
})(jQuery);

    
    var session_keepalive_interval;
    var calculator_dialog;
    var save_as_draft_dialog;
    var myViewModel = new ITRViewModel();
    ko.applyBindings(myViewModel,  document.getElementById('form_wrapper'));

    $(document).ready(
    function()
    {
       
       //$('input[type=text]').addClass('txtbox');       
       $(document).tooltip();      

       session_keepalive_interval = window.setInterval(function()
       {
           $.ajax({
               url: "<?php echo url_for("default/keepAlive") ?>"
           });
       }, 15000);
       
       calculator_dialog = $('#calculator').dialog(
           {
               autoOpen: false,
               title: 'Calculator',
               hide: 'clip'               
           });
    
    
     save_as_draft_dialog = $('#save_as_draft').dialog(
           {
               autoOpen: false,
               title: 'Save and Continue Later',
               hide: 'clip',
               width: 600,               
               modal: true,
               buttons: 
               {
                   'Continue': function() { $('form').append('<input tye="hidden" name="SaveAsDraft" value="1" />').submit(); },
                   'Cancel': function() { $(this).dialog('close');}
               }
               
           });
    
    
        $('.number_input').attr('autocomplete','off');
        $('.help_icon').attr('title','Click here for help').click(function()
        {
            showHelp(this);
        });
        
        var notes_box = $('#itr_submission_notes');
        var notes_char_display = $('#notes_chars');
        $(notes_box).limiter($(notes_box).attr('maxlength'),notes_char_display);
        
        $('#loading_banner').hide();
        $('#form_wrapper').show();
        
        $('#itr_submission_pan_no').change(function()
        {
            if($(this).val().length == 0) 
            {
                return;
            }
            
            if(!validatePAN())
            {
                alert('PAN no you entered is invalid');
                $('#itr_submission_pan_no').val('');
                $('#itr_submission_email_address').focus();
                $('#itr_submission_email_address').focus();
                $('#itr_submission_pan_no').focus();
                return false;
            }
        });
    });        
    
    function validatePAN()
    {
        var regex = new RegExp('[A-Z,a-z]{5}[0-9]{4}[a-z,A-Z]$');
        var pan_no = $('#itr_submission_pan_no').val();
        
        if(pan_no.length !== 10)
        {
            return false;
        }
        
        return pan_no.match(regex);        
    }
    
    function enableTooltip(object)
    {                     
        try
        {                           
            var words = toWords($(object).val());
            $(object).attr( "title", words );            
            $(object).tooltip();        
            $(object).tooltip( "option", "content", words );            
            $(object).tooltip('close');       
            $(object).tooltip('open');       
        }catch(e){}
    }
    
    function showCalculator()
    {
       $(calculator_dialog).dialog('open'); 
    }
    
 // American Numbering System
var th = ['','hundred', 'thousand','thousand', 'lakh', 'lakh', 'crore','crore'];

var dg = ['','one','two','three','four', 'five','six','seven','eight','nine', 'ten','eleven','twelve','thirteen', 'fourteen','fifteen','sixteen', 'seventeen','eighteen','nineteen'];
var tw = ['twenty','thirty','forty','fifty', 'sixty','seventy','eighty','ninety']; 

function toWords(s)
{
    s = s.toString(); 
    s = s.replace(/[\, ]/g,''); 
    if (s != parseFloat(s)) 
        return 'not a number'; 
    
    var x = s.indexOf('.'); 
    
    if (x == -1) x = s.length; 
    if (x > 15) return 'too big';

    var n = s.split(''); 
    var str = ''; 
    var sk = 0; 
    var yog = 1;
	var fnl = '';

	for(var i = x; i>0;i--)
	{
		if( yog == 1 || ( yog%2==0 && yog!=3 ))
		{
			sub_start_index = (i - (i==1?0:1))-1;
			sub_length = (i==1?1:2);			

			num = s.substring( sub_start_index, sub_start_index + sub_length  );
			tmp = getTwo( num );
			if(yog >=3 && yog <= 9 && tmp != "")
			{
				tmp += ' ' + th[yog-2] + ' ';
			}

			fnl = tmp.trim() + ' ' + fnl.trim();
			i--;
			yog++;			
		}
		else
		{
			tmp = getTwo(s.substring(i-1, (i-1)+1 ));		

			if(yog >= 3 && yog <= 9 && tmp != '')
			{
				tmp += ' ' + th[yog-2] + ' ';
			}

			fnl = tmp.trim() + ' ' + fnl.trim();
		}

		yog++;
	}

    str = fnl; 
	 
    if (x != s.length) 
    {
        var y = s.length; 
        var paise = s.substring(x+1);        
        var paise_string = getTwo(paise).trim();        
        if(paise_string.length > 0)
        {
            str += ' rupees & paise '; 
            str +=  paise_string;
        }
    }
    return str.replace(/\s+/g,' ');
}

function getTwo(num)
{
	var n = parseInt(num);
	var first  = (n<10 || n>19)?dg[ parseInt(num.substring(num.length-1)) ]:'';
	var second = "";

	if(n<=9)
	{
	}
	else if(n>9 && n<=19)
	{
		second = dg[n];
	}
	else
	{
	    var n2 = parseInt(num.substring(0,1))-2;
		second = tw[n2];
	}

	return second + (second.length>0?' ':'') + first;
}

function isNumber(evt) 
{
    return true;
    var c = (evt.which) ? evt.which : event.keyCode
    if ((c >= '0'  && c <= '9') || c == '.' )
        return true;    
    return false;
}

function showInfo(column_id,div_title)
{
    try
    {
    var d = document.getElementById("info_"+column_id);

    document.getElementById("info_content").innerHTML="<p>" + d.innerHTML + "</p>";
    document.getElementById("info_title").innerHTML="<h4><table border='0' width='100%'><tr><td>" + div_title + "</tdl><td width=30 height=30 align='right'><img src='images/closebox.png' title='close' onclick='document.getElementById(\"info\").style.display=\"none\";'></td></tr></table></h4>";


    x=(screen.availWidth-400)/2;
    y=(screen.availHeight-300)/2;

    document.getElementById("info").style.left=x+"px";
    document.getElementById("info").style.top=y+"px";
    document.getElementById("info").style.width="400px";
    document.getElementById("info").style.height="300px";
    document.getElementById("info").style.border="1px solid";

    document.getElementById("info").style.display="block";

    }catch(e) { }
}


function showHelp(element)
{        
    try
    {
        var help_id = $(element).attr('help_id');
        var help_div = $('#help_'+help_id);

        x=(screen.availWidth-400)/2;
        y=(screen.availHeight-300)/2;

        document.getElementById("info_content").innerHTML="<p>" + $(help_div).html() + "</p>";
        document.getElementById("info_title").innerHTML="<h4><table border='0' width='100%'><tr><td>" + $(help_div).attr('title') + "</tdl><td width=30 height=30 align='right'><img src='<?php echo public_path("/images") ?>/closebox.png' title='close' onclick='document.getElementById(\"info\").style.display=\"none\";'></td></tr></table></h4>";

        $('#info').css('left',x+'px').css('top',y+'px').css('display','block');    
    }catch(e)
    {
        alert(e.message);
    }
}

var propertyCapitalItem;
function newCapitalPropertyRow()
{
    try
    {
       var purchase = new sharePurchase("","","");
        purchaseArray = new Array();
        purchaseArray[0] = purchase;

        costArray  = new Array();
        costArray[0] = new Income("","","","");
        
        var div_new_capital_property =  document.getElementById('newCapitalPropertyContainer');
        type=7;
        propertyCapitalItem = new CapitalItem(type, "", "", "", "", "", "", purchaseArray,"", Array(), costArray, Array() );
        ko.applyBindingsToNode(div_new_capital_property, null, propertyCapitalItem );
        
        x=(screen.availWidth-400)/2;
        y=(screen.availHeight-300)/2;

        $(div_new_capital_property).css('left',x+'px').css('top',y+'px').css('display','block');    
    }catch(e)
    {
        alert(e.message);
    }
}


</script>
