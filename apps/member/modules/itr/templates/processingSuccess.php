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
            <br /><h1> </h1><br />
            <h2>You have already submitted your return form, our processing desk is now processing your submission.</h2>
            <br />            
        </div>
    </div>
    <div id="navigation" style="margin-top: 10px; text-align: center;">
        <?php echo link_to("Back To Home Page","@homepage", array("class"=>"green-btn"));?>
    </div>
</div>