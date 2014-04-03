<td>
  <ul class="sf_admin_td_actions">
    <li class="sf_admin_action_show">
      <?php echo link_to('<span class="ui-icon ui-icon-mail-closed"></span>'.__('Show', array(), 'messages'), 'ticket/show?id='.$support_ticket->getId(), array()) ?>
    </li>
    <li class="sf_admin_action_sendreply">
      <?php echo link_to('<span class="ui-icon ui-icon-arrowreturnthick-1-w"></span>'.__('Send Reply', array(), 'messages'), 'ticket/sendReply?id='.$support_ticket->getId(), array()) ?>
    </li>
  </ul>
</td>
