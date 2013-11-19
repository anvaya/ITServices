var current_page = 1;

function changePage(byValue)
{
    if(byValue > 0)
    {
        if(current_page == 5)
                return;

        current_page++;
    }
    else
    {
        if(current_page == 1)
                return;

        current_page--;
    }

    myViewModel.currentPage(current_page);
}

function coOwner(name, pan_no, percentage)
{
    var self = this;
    self.name = name;
    self.pan_no = pan_no;
    self.percentage = percentage;
}

function Rent(year, amount)
{
    var self = this;
    self.year = year;
    self.amount = amount;
}

function PropertyInfo(address, city, state, pincode, coowned, coowners, percentage,  letout, tenant, tenant_pan, rent_foregone, taxes_paid, cost, loan_amt, loan_repaid, int_paid, loan_outstanding, prev_rent_received )
{
    var self = this;
    self.address = address;
    self.city	 = city;
    self.pincode = pincode;
    self.coowned = ko.observable(coowned);
    self.coowners = ko.observableArray(coowners);
    self.percentage = percentage;
    self.letout = ko.observable(letout);
    self.tenant = tenant;
    self.tenant_pan = tenant_pan;
    self.rent_foregone = rent_foregone;
    self.taxes_paid = taxes_paid;
    self.cost = cost;
    self.loan_amt = loan_amt;
    self.loan_repaid = loan_repaid;
    self.int_paid = int_paid;
    self.loan_outstanding = loan_outstanding;
    self.prev_rent_received = ko.observableArray(prev_rent_received);
    
    self.addOwner = function()
    {
            self.coowners.push(new coOwner("", "", ""));
    };
}

function sharePurchase(date, quantity, cost)
{
    var self = this;
    self.date = date;
    self.quantity = quantity;
    self.cost     = cost;
    self.remove_flag = ko.observable(0);
}

function CapitalItem(type, name, date_bought, date_sold, qty, purchase_price, sell_value, brokerage, other_charges )
{
    var self = this;
    
    self.type = type;
    self.date_sold = date_sold;
    self.name = name;
    self.date_bought = date_bought;
    self.qty = qty;
    self.purchase_price = purchase_price;
    self.sell_value = sell_value;
    self.brokerage = brokerage;
    self.other_charges = other_charges;       
    self.remove_flag      = ko.observable(0);        
}

function Income(date, amount)
{
    var self = this;
    self.date = date;
    self.amount = amount;
}

function ITRViewModel()
{
    var self = this;
    self.currentPage = ko.observable(1);
    self.properties = ko.observableArray(Array());
    self.capitalItems = ko.observableArray(Array());
    self.capitalItems2 = ko.observableArray(Array());
    self.capitalItems3 = ko.observableArray(Array());
    self.capitalItems4 = ko.observableArray(Array());
    self.capitalItems5 = ko.observableArray(Array());
    self.dividentIncomes = ko.observableArray(Array());
    self.interestIncomes = ko.observableArray(Array());
    self.rentIncomes = ko.observableArray(Array());
    
    self.addProperty = function()
    {
       self.properties.push(new PropertyInfo("", "", "", "", "N", Array(), 100, "N", "", "", "", "", "", "", "", "", "",  Array() ));
    };

    self.addDivident = function()
    {
        self.dividentIncomes.push(new Income("",""));
    };

    self.addInterestIncome = function()
    {
        self.interestIncomes.push(new Income("",""));
    };

    self.addRentIncome = function()
    {
        self.rentIncomes.push(new Income("",""));
    };

    self.addOwner = function(index)
    {
            var details = self.properties();
            details[index].addOwner();
    };
    
    self.addCapitalItem = function(type)
    {        
        switch(type)
        {
            case 1:
                self.capitalItems.push(new CapitalItem(type, "", "", "", "", "", "", "", "" ));        
                break;
            case 2:
                self.capitalItems2.push(new CapitalItem(type, "", "", "", "", "", "", "", "" ));        
                break;
            case 3:
                self.capitalItems3.push(new CapitalItem(type, "", "", "", "", "", "", "", "" ));        
                break;
            case 4:
                self.capitalItems4.push(new CapitalItem(type, "", "", "", "", "", "", "", "" ));        
                break;
            case 5:
                self.capitalItems5.push(new CapitalItem(type, "", "", "", "", "", "", "", "" ));        
                break;
        }
        
    };
}

var myViewModel = new ITRViewModel();
ko.applyBindings(myViewModel);

$(document).ready(
function()
{
   $('input[type=text]').addClass('txtbox'); 
});

