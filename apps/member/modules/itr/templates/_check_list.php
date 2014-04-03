
<div id="page0" data-bind = "visible: currentPage() == 0">
    <?php if($form->hasErrors()):?>
        <h1>Your return information could not be submitted due to validation errors.</h1><br />    
        <h2>Please correct the information marked in <span class="required">red</span> on each page and submit again.</h2>
    <?php else:?>    
        <h1>Before you begin, please make sure you have the following information available with you.</h1><br />    
        <ol>
            <li>Your PAN Card No.</li>
            <li>Your NRO Bank Account No. (Any One) along with IFSC / MICR Code of that Bank Account Branch. </li>
        </ol><br />

        <h2>If you own (fully or co-owned) house property in India:</h2>
        <ol>
            <li>Address. (Locality and City)</li>
            <li>Names, PAN Card No. and % shares of co-owners (If applicable).</li>
            <li>Tenant Information including tenant's PAN No. if property is let out.</li>        
        </ol><br />

        <h2>If you have sold any investments (Shares, Bonds, Mutual Funds etc.):</h2>
        <ol>
            <li>Details of scripts (Stock Code, Mutual Fund Scheme, Bond scheme etc.).</li>
            <li>Dates of Purchase and cost of purchase.</li>
            <li>Date Sold, amount realized and expenses incurred (such as brokerage).</li>        

        </ol><br />

        <h2>If you have received other income:</h2>
        <ol>
            <li>Details of dividend, Interest Received.</li>
            <li>Rent received from sources other than house property.</li>
        </ol>
     <?php endif;?>   
     
     <br />   
    
</div>