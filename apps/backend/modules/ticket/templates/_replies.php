<?php
        $ticket = $form->getObject();        
        /* @var $ticket support_ticket */
?>
<?php
    if($ticket->getId()>0):        
?>
<br /><ul class="sf_admin_actions" style="padding-left: 20px;">
    <li class="sf_admin_action_new">        
        <?php echo link_to('Send Reply', "ticket_comment/new?ticket_id=".$ticket->getId(), array("popup"=>array("reply", "width=600,height=500") ) );?>
    </li>    
</ul><br />
<?php else: ?>
<p>Please save this ticket to add a reply.</p>
    <?php endif;?>
<?php if($ticket->getTicketComment()->count()>0):?>
<div id="reply_accordion">    
<?php foreach( $ticket->getTicketComment() as $comment ): ?>
    <?php /* @var $comment ticket_comment */ ?>
    <?php if($comment->getRepliedBy()): ?>
        <?php $sender = $comment->getSfGuardUser()->getName();?>
    <?php else:?>
        <?php $sender = $ticket->getMember()->getName();?>
    <?php endif;?>
    
    <!--
    <h3 style="padding: 10px 10px 10px 32px; ">
        --><h3><?php echo $sender." - ".format_date($comment->getCreatedAt(), "d-M-y"); ?></h3>
    <div>
        <!--
        <div class="sf_admin_list ui-grid-table ui-widget ui-corner-all ui-helper-reset ui-helper-clearfix" >
        -->
            <?php if($comment->getRepliedBy()):?>
                <table width="100%" cellspacing="2" cellpadding="3">
                    <thead class="ui-widget-header">
                        <th class="ui-state-default ui-th-column sf_admin_text">To Customer</th>
                        <th class="ui-state-default ui-th-column sf_admin_text">Office Comments</th>
                    </thead>
                    <tbody>
                      <tr class="sf_admin_row ui-widget-content odd">
                          <td class="sf_admin_text" width="50%"><?php echo $comment->getPublicMessage() ?></td>
                          <td class="sf_admin_text"><?php echo $comment->getPrivateMessage() ?></td>
                      </tr>
                    </tbody>
                </table>
            <?php else:?>
        <p><?php echo $comment->getPublicMessage();?></p>
            <?php endif;?>

            <?php if($comment->getTicketFile()->count()>0):?>
                <br /><br />
                <strong>Attachments:&nbsp;</strong>
                <?php foreach($comment->getTicketFile() as $index=>$file):?>
                    <?php if($index>0):?>,<?php endif;?>
                    <?php echo link_to($file->getFileName(), "ticket_comment/file?id=".$comment->getId()."&file_id=".$file->getId(), array("popup"=>array("file","width=800,height=600,scrollbars=1" ) ) );  ?>         
                <?php endforeach; ?>
            <?php endif;?>
        <!--            
        </div>
        -->
    </div>
<?php endforeach;?>
</div>
<?php endif;?>
<script type="text/javascript">
    $(document).ready(function()
    {
         $("#reply_accordion").accordion( {heightStyle: "content", event: "click hoverintent"} );
         $('a', '.sf_admin_action_new').button({ icons: { primary: 'ui-icon-arrowreturnthick-1-w' } });
    });
</script>