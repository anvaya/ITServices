<?php
function append_to_slot($name)
{
    // check for the existence of a slot with the same name
    $content = '';
    if (has_slot($name)) $content = get_slot($name);
 
    // regardless, begin capturing the slot
    slot($name);
 
    // echo either a blank string, or the previous value of the slot with the same name
    echo $content;
}
?>

<div id="content" class="col-full">
    <div id="main-sidebar-container">
        <div id="main">
            <div class="post-144 page type-page status-publish hentry">
                <h2 class="title">Frequently Asked Questions</h2>
                <?php //include_component('faq','content',array('slug'=>'faqs'));?>
                <ol class="faq_list">
                    <?php foreach($faqs as $faq):?>
                    <?php /* @var $faq faq */?>
                    <li><a href="#<?php echo $faq->getSlug(); ?>"><?php echo $faq->getQuestion();?></a></li>
                    <?php (has_slot('faq_answers'))? append_to_slot("faq_answers"):slot("faq_answers");?>
                        <div class="faq entry">
                            <h5 id="<?php echo $faq->getSlug();?>"><?php echo $faq->getQuestion();?></h5>
                            <p><?php echo str_replace("\n","<br />", $faq->getAnswer());?></p>
                        </div>
                    <?php end_slot();?>
                <?php endforeach; ?>
                </ol>
                <div class="line1" style="margin-top: 10px;"></div>        
                <?php include_slot("faq_answers");?>
            </div>
        </div>
    </div>
</div>