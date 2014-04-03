<?php  $period = '01/04/'.($fy)." To 31/03/".($fy+1);?>
<div id="page5" data-bind = "visible: currentPage() == 5">
    <h3>Exemptions (For Period: <?php echo $period ?>)</h3>
    <br />    
    
    <?php $np = "itr_submission[exemptions]['+\$index()+']"; ?>
    <?php $np_id = "itr_submission_exemptions_'+\$index()+'_"; ?>
    <table>
        <thead>
            <tr>
                <th>Item<span style="display: none;" class="help_icon" help_id="ex_details" ></span></th>
                <th>Amount<span style="display: none;"  class="help_icon" help_id="other_ex_amount" ></span></th>
            </tr>
        </thead>
        <tbody data-bind="foreach: exemptions">
            <tr>
                <td><label data-bind="text: label" for="<?php echo $np_id ?>_amount"></label></td>
                <td>                    
                    <input type="text" class="number_input" autocomplete="off" data-bind="attr: {'onkeypress': 'return isNumber(event);', 'onkeyup': 'enableTooltip(this);', id: '<?php echo $np_id ?>_amount',  name: '<?php echo $np ?>[amount]'},value: amount" />
                    <input type="hidden" data-bind="attr: {name: '<?php echo $np ?>[category_id]'},value: category_id" />
                </td>                
            </tr>
        </tbody>
    </table>
    
    <br />
    <h3>Any other Information ?</h3>
    <br />    
    <h4>If you would like to tell us about anything not covered in the details you have provided, please add it below</h4>
    <div>
        <?php if($form['notes']->hasError()):?>
            <?php echo $form['notes']->renderError();?>
        <?php endif;?>            
        <?php echo $form['notes'];?>
        <div id="notes_chars"></div>
    </div>
</div>