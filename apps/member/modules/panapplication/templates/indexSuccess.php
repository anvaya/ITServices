<?php use_helper('I18N') ?>
<div id="main_content" style="width: 960px;">
<h1 style="font-size: 18px;" ><?php echo __('Apply for a new Pan Card', null, 'messages') ?></h1>

<ul class='checklist'>    
    <li> All fields marked with a <span class="mandatory">* </span> are mandatory.</li>
    <li>Click the <?php echo image_tag('q.gif', array('style'=>'display: inline-block') ); ?> icon to the right of each section for detailed information on that section.</li>
    <li>In case you are having difficulties with certain questions, please click the "Online Chat" button or Call us at +91-000000. </li>
    <li>It is assumed that all information you fill here is true and correct to the best of your knowledge.</li>    
</ul>    
<p class='bold_message'>
    Please fill-in the following information for your new PAN card.
</p>
<?php echo get_partial('panapplication/form', array('sub_form' => $sub_form)) ?>
  <div style="clear:both;"></div>
</div><?php include_partial("panapplication/script");?>