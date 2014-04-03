<?php
    /* @var $newsnevent newsnevent */
    $event_date = $newsnevent->getEventDate();
?>


<span class="subtitle">
    <?php if($event_date):?> On <?php echo  format_date( $event_date,"dd/MM/yyyy");?><?php endif;?>
</span>
<div class="entry">    
    <div class="picture">
        <?php echo image_tag("/uploads/events/".$newsnevent->getPictureFile());?>
    </div>    
    <div class="text">
        <p>

            <?php echo str_replace("\n","<br />", $newsnevent->getEventBody());?>
        </p>
    </div>
</div>
