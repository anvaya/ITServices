<?php

    /* @var $product product */
?>
<style type="text/css">
    ul
    {
        margin-left: 30px;
    }
    
    ul li
    {
        font-size: 12px;
        color: black;
        padding:5px;                
    }
</style>
<div id="form_wrapper">    
    <div id="form_pages">
        <div id="page_heading">
            <h3><?php echo $product->getName(); ?></h3>            
        </div>
        <div>
            <br /><h1> Thank You !</h1><br />
            <h2>Your return information has been submitted successfully to our processing desk.</h2>
            <br />
            <h3>Whats Next ?</h3>
            <br />
            <ul>
                <li>Our experts will review your information and contact you for further details if required.</li>
                <li>Your draft return will be prepared and shared with you. You will also be asked to make your income tax payments (if applicable).</li>                
                <li>Your income tax return will be filed with the Income Tax department and acknowledgement sent to you for your signature.</li>
            </ul>
        </div>
    </div>
    <div id="navigation" style="margin-top: 10px; text-align: center;">
        <?php echo link_to("Back To Home Page","@homepage", array("class"=>"green-btn"));?>
    </div>
</div>

