<div id="sf_admin_container"><?php /* @var $ticket support_ticket */?>
<h1>Details of your Query</h1>
<div id="sf_admin_content">
    <ul class="sf_admin_actions">
        <?php echo $helper->linkToList(array(  'label' => 'Back',  'params' =>   array(  ),  'class_suffix' => 'list',)) ?>
        <li class="sf_admin_action_list">
            <?php echo link_to('<span class="ui-icon ui-icon-arrowreturnthick-1-w"></span>Send Reply', "ticket/sendReply?id=".$ticket->getId(), array("style"=>"background: #dfeffc url(/css/redmond/images/ui-bg_glass_85_dfeffc_1x400.png) 50% 50% repeat-x", "class"=>"fg-button ui-state-default fg-button-icon-left") );?>
        </li>
            <?php //echo $helper->linkToList(array(  'label' => 'Back',  'params' =>   array(  ),  'class_suffix' => 'list',)) ?>
    </ul>
    <br />
    
    <table>
        <tr>
            <th>Subject:</th>
            <td><?php echo $ticket->getTicketSubject() ?></td>
        </tr>
        <tr>
            <th>Date Created:</th>
            <td><?php echo format_date($ticket->getDateReceived(),"dd/MM/y"); ?></td>
        </tr>
    </table>
    
    
    <?php if($ticket->getTicketComment()->count()>0):?>
    <div id="reply_accordion">    
    <?php foreach( $ticket->getTicketComment() as $comment ): ?>
        <?php /* @var $comment ticket_comment */ ?>
        <?php if($comment->getRepliedBy()): ?>
            <?php $sender = "Reply from Support"; //$comment->getSfGuardUser()->getName();?>
        <?php else:?>
            <?php $sender = $ticket->getMember()->getName();?>
        <?php endif;?>

        <h3><?php echo $sender." - ".format_date($comment->getCreatedAt(), "d-M-y"); ?></h3>
        <div>
            <!--
            <div class="sf_admin_list ui-grid-table ui-widget ui-corner-all ui-helper-reset ui-helper-clearfix" >
            -->
                <?php if($comment->getRepliedBy()):?>
                    <table width="100%" cellspacing="2" cellpadding="3">
                        <thead class="ui-widget-header">
                            <th class="ui-state-default ui-th-column sf_admin_text">To You:</th>                            
                        </thead>
                        <tbody>
                          <tr class="sf_admin_row ui-widget-content odd">
                              <td class="sf_admin_text" width="50%"><?php echo $comment->getPublicMessage() ?></td>                              
                          </tr>
                        </tbody>
                    </table>
                <?php else:?>
                    <table width="100%" cellspacing="2" cellpadding="3">
                        <thead class="ui-widget-header">
                            <th class="ui-state-default ui-th-column sf_admin_text">From You:</th>                            
                        </thead>
                        <tbody>
                          <tr class="sf_admin_row ui-widget-content odd">
                              <td class="sf_admin_text" width="50%"><?php echo $comment->getPublicMessage() ?></td>                              
                          </tr>
                        </tbody>
                    </table>                    
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
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function()
    {
         $("#reply_accordion").accordion( {heightStyle: "content", event: "click hoverintent"} );
         $('a', '.sf_admin_action_new').button({ icons: { primary: 'ui-icon-arrowreturnthick-1-w' } });
    });
</script>