<?php

$order = $form->getObject();
$products = order_itemTable::getInstance()
            ->createQuery('oi')
            ->innerJoin('oi.product pr')
            ->select('pr.name as product_name, oi.price')
            ->addWhere('oi.order_id = ?', $order->getId())
            ->fetchArray();
?>
<div class="sf_admin_form_row sf_admin_text">
<table>
    <tr>
        <th>Product</th>
        <th>Price</th>
    </tr>
    <?php foreach($products as $product):?>
    <tr>
        <td><?php echo $product["product_name"]; ?></td>
        <td><?php echo $product["price"]; ?></td>
    </tr>
    <?php endforeach;?>
</table>
</div>
