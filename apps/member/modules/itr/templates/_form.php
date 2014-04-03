<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<style type="text/css"> 
    
    #page_content 
    {
        width: 99%;
        margin-top: 30px;
    }
 
    #pages_navigation
    {
        float: left;      
        position: fixed;
    }
    
    #pages_navigation ul
    {
          list-style-image: url("/images/next.png");
          margin-left: 20px;
          margin-top: 60px;
          text-align: left;
    }
    
    #pages_navigation ul li
    {
        font-size: 16px;
        color: white;
        padding:5px;
        background-color: #5e5e5e;
        margin-bottom: 5px;
        vertical-align: middle;        
        line-height: normal;
        width: 200px;
        cursor: pointer;
    }
    
    #pages_navigation ul li.active
    {
        background-color: #E48605;
    }
    
    #pages_navigation ul li.error
    {        
        background-color: red;
    }
    
    #pages_navigation ul  li span 
    {
        display: inline-block;
        line-height: normal;
        padding-top: 15px;
        vertical-align: top;
    }
    
    #form_pages
    {
        margin-left: 250px;   
        /*height: 490px;
        overflow-y: scroll;*/
    }
    
    #page_navigation 
    {
        margin-top: 10px;
        text-align: center;
        padding: 4px;
                
        /*background-color: #8AA6C1;*/
    }
    
    #form_pages h4
    {
        font-size: 15px;
        text-align: left;
        color: black;
    }
    
    .capital_purchase input
    {
        width: 80px;
    }
    
    #page0 ol, #page6 ol
    {
        padding-top: 5px;
    }
    
    #page6 ol
    {
        margin-left: 30px;
    }
    
    #page6 h3
    {
        margin-top: 10px;
        margin-bottom: 5px;
    }
    
    #page0 ol li, #page6 ol li
    {
        color: #35353A;
        font-size: 1.1em;
    }
    
    #itr_submission_first_name,
    #itr_submission_middle_name,
    #itr_submission_last_name
    {
        width: 200px;
    }
    
    .row_error
    {
        border: 1px solid red;
        padding: 4px;
    }
    
    span.required
    {
        color: red;
    }
    
    ul.error_list
    {
        /*list-style-type: none;        */
        list-style-image: url('<?php echo public_path('images') ?>/error.png');
    
    }
    
    #save_as_draft
    {
        padding-left: 5px;
    }
    
    #save_as_draft p
    {
        text-align: left;
        font-size: 1.05em;
        color: black;
        padding-left: 0px;
    }
    
    #save_as_draft ul
    {
        margin-left: 15px;
    }
    
    #save_as_draft ul li
    {
        color: black;
        font-size: 1.05em;
        padding-bottom: 5px;
    }
    

    ul.error_list li
    {
        display: inline-block;
        color: white;
        background-color: red;
        font-weight: bold;
        min-width: 150px;
        padding: 2px;
        padding-left: 20px;
        background-image: url('<?php echo public_path('images') ?>/error.png');        
        background-repeat: no-repeat;
        background-position: left center;
    }
    
    table#full_name td
    {
        border-style: none;
        padding-left: 0;
    }
    
    .ui-accordion-content
    {
        background-color: white;
    }
    
    #page_heading
    {
        margin-bottom: 10px;
    }   
    
    #page_footer
    {
        margin-left: 240px;
    }
    
    tr.error td
    {
        background-color: #6E0000;
        background-image: url("<?php echo public_path("/images/error.png");?>");
        background-position: 3px center;
        background-repeat: no-repeat;
        color: #FFFFFF;
        padding-left: 24px;
    }
    
    div.error
    {
        background-color: #6E0000;
        background-image: url("<?php echo public_path("/images/error.png");?>");
        background-position: 3px center;
        background-repeat: no-repeat;
        color: #FFFFFF;
        padding-left: 24px;
        padding-top: 5px;
        padding-bottom: 5px;
        margin-top: 5px;
        margin-bottom: 5px;
    }
    
    .number_input
    {
        text-align: right;
    }
    
    
    input.details
    {
        width: 250px;               
    }
    
    td.separator
    {
        border: 1px solid green;
        background-color: green;
    }
    
    span.help_icon
    {
        background-image: url('<?php echo public_path('images/q.gif')?>');
        background-repeat: no-repeat;
        display: inline-block;
        width: 16px;        
        height: 16px;
        margin-left: 3px;
        cursor: pointer;
    }
    
    #info h4
    {
        margin-top: 0px;
        margin-bottom: 0px;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 13px;
        color: #0984A5;
        padding: 5px 10px 5px 10px;
        text-align: center;
        background: url('<?php echo public_path('/images'); ?>/head_img.gif') bottom right repeat-x;
        border: 1px #A6AEB2 solid;
    }
    
    #info td
    {
        border-style: none;
    }
    
    #info
    {
        width: 600px;
        height: 400px;
        border: 1px solid;
        display: none;        
    }
    
    #info #info_content
    {
        overflow-y: scroll;
    }
    
    span.question, span.answer
    {
        display: block;        
        text-align: left;
    }
    
    span.question
    {
        font-weight: bold;
        margin-top: 6px;
    }
</style>

<form action="<?php echo url_for('itr/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>

<?php $product = productTable::getInstance()
                    ->find($form['product_id']->getValue());
      /* @var $product product */              
      $fy = $product->getFy();      
?>

<div id="loading_banner" style="border: 1px solid #eee; text-align: center; padding: 100px;">
<h1>Loading please wait...</h1>
</div>
<div id="form_wrapper" style="display: none;">
    <div id="form_errors">
        <?php echo $form->renderGlobalErrors() ?>
    </div>
    <div id="pages_navigation" data-bind='visible: currentPage()>0' style="background-color: white">
        <ul>
            <li data-bind="css: {active:  currentPage() == 1, error: hasErrors(1)}" onclick="changeToPage(1); return false;"><span>Personal Information</span></li>
            <li data-bind="css: {active:  currentPage() == 2,  error: hasErrors(2)}"  onclick="changeToPage(2); return false;"><span>House Property Information</span></li>
            <li data-bind="css: {active:  currentPage() == 3,  error: hasErrors(3)}"  onclick="changeToPage(3); return false;"><span>Capital Gains</span></li>
            <li data-bind="css: {active:  currentPage() == 4,  error: hasErrors(4)}"   onclick="changeToPage(4); return false;"><span>Other Income</span></li>
            <li data-bind="css: {active:  currentPage() == 5,  error: hasErrors(5)}"  onclick="changeToPage(5); return false;"><span>Exemptions</span></li>
            <li data-bind="css: {active:  currentPage() == 6  }"><span>Final Confirmation</span></li>
        </ul>
    </div>
    
    <div id='page_navigation'>
            <button id="cmdPrev" class="green-btn" onclick="changePage(-1); return false;" data-bind = "visible: currentPage() > 0 && currentPage() <= 6">Previous</button>
            <button id="cmdNext" class="purple-btn" onclick="changePage(1); return false;" data-bind = "visible: currentPage() < 6">Next</button>
            <input type="submit" class="purple-btn" id="cmdSave" onclick="return confirm('Sending this information to our processing desk, are you sure?');" data-bind = "visible: currentPage() == 6" value="Submit Information"></input>
            <a href="#" onclick="showCalculator(); return false;">Calculator</a>
    </div>
    
    <div id="form_pages">
        <div id="page_heading" data-bind="visible: currentPage() >= 0">
            <h3><?php echo $product->getName(); ?></h3>
            <p style="color: white;" data-bind="visible: currentPage() < 6 && currentPage() > 0">Please fill in the following details to the best of your knowledge</p>
        </div>
        
        <?php include_partial("check_list", array("form"=>$form,"fy"=>$fy) );?>
        <?php include_partial("personal_details", array("form"=>$form,"fy"=>$fy) );?>
        <?php include_partial("properties", array("form"=>$form,"fy"=>$fy) );?>
        <?php include_partial("capital_gains", array("form"=>$form,"fy"=>$fy));?>
        <?php include_partial("other_income", array("form"=>$form,"fy"=>$fy));?>        
        <?php include_partial("exemption", array("form"=>$form,"fy"=>$fy));?>        
        <?php include_partial("confirmation", array("form"=>$form,"fy"=>$fy));?>        
    </div>
    <div id='page_navigation'>
        <button id="cmdPrev" class="green-btn" onclick="changePage(-1); return false;" data-bind = "visible: currentPage() > 0 && currentPage() <= 6">Previous</button>
	<button id="cmdNext" class="purple-btn" onclick="changePage(1); return false;" data-bind = "visible: currentPage() < 6">Next</button>
	<input type="submit" class="purple-btn" id="cmdSave" onclick="return confirm('Sending this information to our processing desk, are you sure?');" data-bind = "visible: currentPage() == 6" value="Submit Information" />
        
        <input type="submit" name="SaveAsDraft" onclick="$('#save_as_draft').dialog('open'); return false;" title="Want to complete your submission later ? Click this button, we will save everything you entered to finish up later." style="margin-left: 20px;" class="silver-btn" id="cmdSaveDraft" data-bind = "visible: currentPage() > 1" value="Save & Resume Later" /></input>    
    </div>
</div>
<?php echo $form->renderHiddenFields(false) ?>         

</form>

<?php //include_partial("capital_group_property_edit", array("form"=>"form","itemIndex"=>7) );?>

<div id="calculator" style="display: none; width: 280px; height: 330px; padding: 0px;">
    <iframe src="<?php  echo public_path("calcbyanoop.html") ?>" width="280" height="325" frameborder="0"></iframe>
</div>
<div id="save_as_draft" style="display: none; background-color: white">
    <p>
        This feature allows you to save the data you entered as draft and allow you to submit later.
    </p>
    <br />
    
    <p>Please note the following:</p>
    
    <ul>
        <li>If you have uploaded a capital gains statement from your broker, it will NOT be saved. You will need to upload it again when you resume next time.<br /></li>
        <li><b>This is not a submission</b>, changes you have made are considered draft and will NOT be sent to our processing desk. You must complete the form and "submit" it in order to have it processed.</li>
    </ul>      
</div>
 <div id="info" class="hidden" style="position:fixed;z-index:10; background-color:white;">
    <div id="info_title"></div><br/>
    <div id="info_content"></div>
</div>
<?php include_partial("script", array("form"=>$form,"fy"=>$fy) );?>