<?php use_helper("Date"); ?>
<div id="content" class="col-full">
    <div id="main-sidebar-container">
        <div id="main">
            <div class="post-144 page type-page status-publish hentry">
            <h2 class="title">News and Events</h1><br />
                <div id="accordion">                    
                    <?php foreach ($newsnevents as $newsnevent): ?>                                       
                        <h3 ><?php echo $newsnevent->getTitle();?></h3>
                        <div class="event_item">
                        <?php 
                                /* @var $newsnevent newsnevent */ 
                                if($newsnevent->getPictureFile()):
                                    include_partial("display_block_with_picture", array("newsnevent"=>$newsnevent));
                                else:
                                    include_partial("display_block", array("newsnevent"=>$newsnevent));
                                endif;
                        ?>
                        </div>                        
                    <?php endforeach;?>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function()
    {
        $('#accordion').accordion({heightStyle: "content", collapsible: true, active: false});
    });
</script>