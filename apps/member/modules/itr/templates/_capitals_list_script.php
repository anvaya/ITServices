var capital_list_<?php echo $index ?> = Array();
<?php foreach($form['capitals'.$index] as $k=>$cp):?>
    category_id = "<?php echo $cp['category_id']->getValue(); ?>";
    date_sold    = <?php echo jqxDate($cp['date_sale']->getValue()); ?>;
    qty          = "<?php echo $cp['quantity_sold']->getValue(); ?>";
    details     = "<?php echo $cp['details']->getValue(); ?>";
    sell_value  = "<?php echo $cp['sell_value']->getValue(); ?>";
    brokerage   = "<?php echo $cp['brokerage_paid']->getValue(); ?>";
    other_charges = "<?php echo $cp['other_expenses']->getValue(); ?>";
    id          = "<?php echo $cp['id']->getValue(); ?>";
     <?php 
            $pinfo = $cp['purchase_info']->getValue();
            if(!is_array($pinfo))
            {                   
                if(strlen($pinfo))
                {
                    $pinfo = json_decode($pinfo, true);                                
                }
                else
                {
                    $pinfo = array();
                }
            }       
            
            $cinfo = $cp['addon_costs']->getValue();
            if(!is_array($cinfo))
            {
                if(strlen($cinfo))
                {
                    $cinfo = json_decode($cinfo, true);
                }
                else
                {
                    $cinfo = array();
                }
            }
            
            $einfo = $cp['addon_expenses']->getValue();
            if(!is_array($einfo))
            {
                if(strlen($einfo))
                {
                    $einfo = json_decode($einfo, true);
                }
                else
                {
                    $einfo = array();
                }
            }
    ?>                
    purchase_info   = Array();
    addon_costs   = Array();
    addon_expenses   = Array();
    
    errors = Array();

    <?php $check_fields = array("date_sale","quantity_sold"); ?>
    <?php foreach($check_fields as $idx=>$fld):?>
        <?php if($cp[$fld]->hasError()):?>                
            errors['<?php echo $fld ?>'] = "<?php echo str_replace("]","", str_replace($fld." [", "", $cp[$fld]->getError()->getMessage()) );?>";
        <?php endif;?>    
    <?php endforeach;?>
    
    <?php if(count($pinfo)>0):?>         
        <?php foreach($pinfo as $key=>$pur):?>
            purchase_info[<?php echo $key ?>] = new sharePurchase("<?php echo $pur['date'] ?>","<?php echo $pur['quantity'] ?>","<?php echo $pur['cost'] ?>");
        <?php endforeach;?>
    <?php else:?>
         purchase_info[0] = new sharePurchase(new Date(),"","");   
    <?php endif;?>
         
    <?php foreach($cinfo as $key=>$cost):?>
        addon_costs[<?php echo $key ?>] = new Income(<?php echo jqxDate($cost['date']) ?>,"<?php echo $cost['amount'];?>","0","<?php echo $cost['details'] ?>"); 
    <?php endforeach;?>    
        
    <?php foreach($einfo as $key=>$cost):?>
       addon_expenses[<?php echo $key ?>] = new Income(<?php echo jqxDate($cost['date']) ?>,"<?php echo $cost['amount'];?>","0","<?php echo $cost['details'] ?>"); 
    <?php endforeach;?>       
       
    capital_list_<?php echo $index ?>[<?php echo $k ?>] = new CapitalItem(<?php echo $index;?>, details, date_sold, qty, sell_value, brokerage, other_charges, purchase_info, id, errors, addon_costs, addon_expenses );
<?php endforeach;?>
