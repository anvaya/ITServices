var other_income_<?php echo $index ?> = Array();
<?php foreach($form['otherincome'.$index] as $k=>$cp):?>
    category_id = "<?php $cp['category_id']->getValue(); ?>";
    <?php 
            $date = $cp['date_rcvd']->getValue();
            if(strlen($date)==0):
    ?>
        date    = "";
    <?php else:?>   
        <?php $date_parts = explode("-", $date);?>
        <?php if(count($date_parts)>1 && is_numeric($date_parts[0]) && is_numeric($date_parts[1]) && is_numeric($date_parts[2]) ):?>
            date = new Date(<?php echo $date_parts[0]; ?>,<?php echo $date_parts[1]-1; ?>,<?php echo $date_parts[2]; ?>);
        <?php else:?>
            date = <?php echo jqxDate($date);?>;
        <?php endif;?>
    <?php endif;?>
    amount         = "<?php echo $cp['amount']->getValue(); ?>";    
    id          = "<?php echo $cp['id']->getValue(); ?>";
    details     =  "<?php echo $cp['details']->getValue(); ?>";   
    other_income_<?php echo $index ?>[<?php echo $k ?>] = new Income(date, amount, id, details );
<?php endforeach;?>
