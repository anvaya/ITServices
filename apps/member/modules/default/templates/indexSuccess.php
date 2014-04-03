<?php use_javascript("jquery.blockUI.js"); ?>
<style type="text/css">
    body { background-color: #333;}
    #page_content { width: 99%; }
    #main_content { width: 95%; height: 90%; font-family: verdana, arial, tahoma; }
    
        
    .dashboard_left
    {
        color: white;
        width: 238px;
        height: 450px;
        float: left;
        border-right: 1px #6B6B6B solid;
    }            
    
    .metro_green
    {
        background-color: #F09709;
        border-color: #090;
        width: 90%;
        height: 120px;
        text-align: center;
    }
    
    .metro_green h3
    {
        font-size: 1.6em;
        font-weight: normal;
        padding-top: 90px;
        color: white;        
    }
    
    ul.dashboard_menu_left
    {
        list-style-image: url('/images/next.png');        
        margin-top: 30px;
        text-align: left;
        margin-left: 40px;
    }
    
    ul.dashboard_menu_left li
    {
         font-size: 1.2em;
         color: #C2CBE0; 
         padding-left: 2px;
    }
    /*
    ul.dashboard_menu_left li {
        width           : 200px;
        line-height     : 100px;
        height          : 100px;
        border          : 1px blue solid;        
    }*/
    
    ul.dashboard_menu_left li span 
    {
        display             : -moz-inline-box;  /* FF2 or lower */
        display             : inline-block;     /* FF3, Opera, Safari */
        line-height         : normal;
        vertical-align      : top;    
        padding-top: 15px;
    }

    ul.dashboard_menu_left  li span     { *display  : inline;} /* haslayout for IE6/7 */
    
    ul.dashboard_menu_left  li:hover
    {
       background-color: #F09709;
       color: white;
       cursor: pointer;
    }
    
    .dashboard_center
    {
        margin-left: 250px;
        margin-right: 250px;
        min-height: 450px;                 
    }
    
    .dashboard_right
    {
        float: right;
        color: white;
        width: 238px;
        height: 450px;        
        border-left: 1px #6B6B6B solid;
    }    
        
    .info_block h3
    {
        background-color: #2E444F; /*#083C72;*/
        color: white;
        text-align: center;
        font-size: 1.6em;
        font-weight: normal;
        margin-left: 5px;
        margin-bottom: 10px;
    }
    
    .info_block p
    {
        color: #C2CBE0;
        text-align: left;
        font-size: 1.1em;
        padding-top: 4px;
    }
    
    ul.edit_list
    {
        list-style-type: none;        
        margin-top: 15px;
        margin-bottom: 5px;
    }    
    
    ul.edit_list li
    {
        border-top: 1px solid white;
        border-bottom: 1px solid white;
        padding-top: 10px;
        
    }
    
    ul.edit_list li > span
    {
        background-image: url("/images/edit.png");
        background-repeat: no-repeat;
        padding-left: 55px;
        display: inline-block;        
        height: 52px;
        font-size: 1.5em;               
        padding-top: 12px;
        color: #C2CBE0;
        width: 400px;
    }
    
    #services_income_tax, 
    #services_consultancy,
    #services_other
    { display: none; }
    
    .white_text
    {
        color: #fff;
    }
</style>
<div id="right_side">
</div>
<div id="main_content">
    <?php
            $member = memberTable::getInstance()->find($sf_user->getGuardUser()->getId());            
            /* @var $member member */
    ?>
    <h3 class="white_text">Welcome <?php echo $member->getQualifiedName(); ?></h3>
    <br />     
    <?php //echo link_to("Apply For New PAN Card","panapplication/index", array("class"=>"purple-btn") );?>
    
    <div class="dashboard_left">
        <div class="metro_green">
            <h3>Our Services</h3>
        </div>            
        <ul class="dashboard_menu_left">
            <li item_id="1"><span>Income Tax Return</span></li>
            <li item_id="2"><span>Consultancy</span></li>
            <li item_id="3"><span>Others</span></li>
        </ul>        
    </div>
    
    <div class='dashboard_right'>
        <div class='info_block'>
            <!--<h3>Alerts</h3>-->
        </div>
    </div>
    
    
    
    <div class='dashboard_center' class="ui-corner-all">
        
        <div id='services_income_tax' >
            <div class='info_block'>
                <h3>Income Tax Returns Service</h3>
                
                <p>We help you file your income tax returns. Just fill up a simple 
                    form with relevant details, and we will take care of the rest.</p>
                <p>Select a return to file:</p>
                    
                <ul class="edit_list">
                    <?php
                            /* @var $member member */
                            $products = $member->getProductList(productTable::CATEGORY_IT_RETURNS);                                    
                            foreach($products as $pid=>$product): /* @var $product product */
                    ?>                   
                    <li>
                        <span><?php echo $product ?></span>
                        <a href="<?php echo url_for("itr/new?pid=".$pid) ?>" class="green-btn">Submit Now</a>
                    </li>                    
                    <?php   endforeach;?>
                </ul>
                
                <p style="font-weight: bold">Buy more:</p>
                <?php include_component("product","buyList",array("category_id"=>"4" ) );?>
            </div>
        </div>
        
        <div id="services_consultancy" >
            <div class='info_block'>
                <h3>Have a query ?</h3>
                
                <p>Get your queries answered by our team of experts:</p>
                <p>&nbsp;</p>
                    
                <p align="center"><a href="<?php echo url_for("@support_ticket") ?>" class="green-btn">Ask a question</a></p>                              
            </div>
        </div>
        
        <div id="services_other" >
            <div class='info_block'>
                <h3>More Services</h3>
                
                <p style="font-weight: bold">Buy more:</p>
                <?php include_component("product","buyList",array("category_id"=>  false ) );?>                                
                
            </div>
        </div>
        
    </div>
    
    
    
</div>

<?php if($show_itr_selection): ?>
<div id="itr_selector" style="display: none;">
    <form method="get" action="<?php echo url_for("itr/selectYear") ?>">
        <h1>Select Income Tax Return Year</h1>
        <p>
            As part of your subscription, you can file Income Tax Return for one financial year. <br />
            Please select the year you wish to file return for. <br /> 
        </p>
        <ul>
            <?php foreach($itr_products as $ip):?>
                <li>
                    <input type="radio" name="itr_year" value="<?php echo $ip['id'] ?>" />&nbsp;<?php echo $ip['name'];?>
                </li>
            <?php endforeach;?>        
        </ul>
        <p>
            You can always purchase return service for other financial years you wish to file.
        </p>
        <br /><br />
        <p style="text-align: center">
            <input type="submit" value="Apply" class="green-btn" />&nbsp;
            <a class="purple-btn" href="#" onclick="$.unblockUI(); return false;">Cancel</a>
        </p>
    </form>
</div>
<?php endif;?>

<script type="text/javascript">
    $(document).ready(function()
    {
        $('li','.dashboard_menu_left').click(function()
        {
            $('#services_income_tax').hide();
            $('#services_consultancy').hide();
            $('#services_other').hide();
            
            var li_item = $(this);
            var item_id = $(li_item).attr('item_id');
            
            switch(item_id)
            {
                case "1":
                    $('#services_income_tax').fadeIn(600);
                    //$('#services_income_tax').show("slide", {direction: "up" }, 500 );
                    break;
                case "2":
                    $('#services_consultancy').fadeIn(600);
                    break;
                case "3":
                    $('#services_other').fadeIn(600);
                    break;
            }
            
        });

<?php if($show_itr_selection): ?>
        $.blockUI({ message: $('#itr_selector') });
<?php endif;?>        
    });
</script>