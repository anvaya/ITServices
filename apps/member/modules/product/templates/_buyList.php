<style type="text/css">
    .product_box
    {
        height: 200px;
        width: 175px;
        border: 1px solid #444;
        padding: 2px;
        text-align: center;
    }
    
    .product_box h3
    {
        font-size: 16px;
        height: 60%;
        background-color: transparent;
    }
    
    #product_list ul
    {
        list-style-type:  none;
        margin-top: 15px;        
        margin-bottom: 15px;        
    }
    
    .product_box p
    {
        text-align: center;
    }
    
    #product_list ul li
    {
        display: inline-block;        
        margin-left: 10px;        
        background-color: #005580;
    }
    
    #product_list ul li:hover
    {
        
        box-shadow: 10px 10px 5px #444;
        cursor: pointer;
        margin-top: 2px;
        margin-left: 12px;                
    }
</style>
<div id="product_list">
    <ul>
        <?php foreach($products as $product): /* @var $product product */?>
        <?php if(!($product->getPrice()>0)) continue;?>
        <li>
            <div class="product_box ui-corner-all">
                <h3><?php echo $product->getName() ?></h3>
                <p style="font-weight: bold">USD <?php echo $product->getPrice();?></p>
                <a class="green-btn" href="<?php echo url_for('@cart_add?id='.$product->getId()) ?>" class="green-btn">Buy Now</a>
            </div>
        </li>
        <?php endforeach;?>
    </ul>
</div>
