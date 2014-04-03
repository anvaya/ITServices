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
            <br /><br />
            <h2>Your draft return information has been saved successfully. You can complete and submit it later.</h2>
            
            <br />            
        </div>
    </div>
    <div id="navigation" style="margin-top: 10px; text-align: center;">
        <?php echo link_to("Back To Home Page","@homepage", array("class"=>"green-btn"));?>
    </div>
</div>

