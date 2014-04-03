<?php
        $categories = product_categoryTable::getInstance()
                        ->createQuery()
                        ->select('id, type_name')
                        ->orderBy('type_name')
                        ->execute();
        
        
        
?>
<h1>Available Services</h1><br />
<style type="text/css">
    .product_box
    {
        height: 200px;
        width: 175px;
        border: 1px solid #ccc;
        padding: 2px;
        text-align: center;
    }
    
    .product_box h3
    {
        font-size: 16px;
        height: 60%;
    }
    
    #product_list ul
    {
        list-style-type:  none;
        margin-top: 15px;        
        margin-bottom: 15px;        
    }
    
    #product_list ul li
    {
        display: inline-block;        
        margin-left: 10px;
    }
</style>
<div id="product_list">
    <?php foreach($categories as $category): /* @var $category product_category */ ?>
        <?php $products = $category->getProduct();?>
        <div class="category_head ui-widget ui-corner-all">
            <h3 class="ui-widget-header ui-corner-all">&nbsp;<?php echo $category->getTypeName(); ?></h3>
            <ul>
                <?php foreach($products as $product): /* @var $product product */?>
                <?php if(!($product->getPrice()>0)) continue;?>
                <li>
                    <div class="product_box ui-corner-all">
                        <h3><?php echo $product->getName() ?></h3>
                        <p style="font-weight: bold">AED <?php echo $product->getPrice();?></p>
                        <a class="green-btn" href="<?php echo url_for('@cart_add?id='.$product->getId()) ?>" class="green-btn">Buy Now</a>
                    </div>
                </li>
                <?php endforeach;?>
            </ul>
        </div> 
    <?php endforeach;?>
</div>
