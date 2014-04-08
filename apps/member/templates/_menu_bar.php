<?php    
     
     $subscribed = array();
     
     if($sf_user->isAuthenticated())
     {
        $member = memberTable::getInstance()->find($sf_user->getGuardUser()->getId());
        /* @var $member member */
        $subscription = member_subscriptionTable::getInstance() 
                            ->createQuery('ms')
                            ->addWhere('member_id = ?', $member->getId())
                            ->addWhere('active = 1')    
                            ->orderBy('id desc')
                            ->fetchOne();
        
        $my_services = productTable::getInstance()
                        ->createQuery('p')
                        ->innerJoin('p.subscription_product sp')                        
                        ->addWhere('p.category_id <> ?', product_categoryTable::CATEGORY_ITR )
                        ->addWhere('sp.subscription_id = ?', $subscription->getSubscriptionId())
                        ->orderBy('p.name')
                        ->execute();        

        /* @var $subscription member_subscription */
        $itr_product = false;
        if($subscription->getItrProductId())
        {
            $itr_product = productTable::getInstance()->find($subscription->getItrProductId());
            $subscribed[$itr_product->getId()] = 1;
            $my_services->add($itr_product);
        }
        
        $ordered_services = productTable::getInstance()
                                ->createQuery('p')
                                ->innerJoin('p.order_item sp')                        
                                ->innerJoin('sp.order oo')                        
                                ->addWhere('oo.member_id = ?', $member->getId() )
                                ->addWhere('oo.status = ?', orderTable::ORDER_STATUS_PAID)
                                ->orderBy('p.name')
                                ->execute();
        
        $other_services = productTable::getInstance()
                        ->createQuery('p')                        
                        ->addWhere('p.price > 0')
                        ->addWhere('p.expired is null or p.expired = 0')
                        ->orderBy('p.name')
                        ->execute();
     }
     else
     {
         $my_services = array();
     }
     
?><?php if($sf_user->isAuthenticated()):?>
            <div id='jqxWidget'>           
                <ul>
                    <li><a href="<?php echo url_for("@homepage") ?>">Home</a></li>
                    <li><a href="<?php echo public_path("index.php/content/aboutUs");?>">About Us</a></li>
                    
                    <?php if(count($my_services)>0):?>
                        <li>
                            <a href="#">My Services</a>                                                
                            <ul>
                                <?php foreach($my_services as $product): /* @var $product product */?>        
                                <?php $subscribed[$product->getId()] = 1;?>
                                <li>
                                    <?php if($product->getCategoryId()==productTable::CATEGORY_IT_RETURNS):?>
                                        <?php echo link_to($product->getName(), "itr/new?pid=".$product->getId());?>
                                    <?php else:?>
                                        <a href="#"><?php echo $product->getName();?></a>
                                    <?php endif;?>
                                </li>
                                <?php endforeach;?>
                                
                                <?php foreach($ordered_services as $product): /* @var $product product */?>    
                                <?php if(isset($subscribed[$product->getId()])) continue;?>
                                <?php $subscribed[$product->getId()] = 1;?>
                                <li>
                                    <?php if($product->getCategoryId()==productTable::CATEGORY_IT_RETURNS):?>
                                        <?php echo link_to($product->getName(), "itr/new?pid=".$product->getId());?>
                                    <?php else:?>
                                        <a href="#"><?php echo $product->getName();?></a>
                                    <?php endif;?>
                                </li>
                                <?php endforeach;?>
                                
                            </ul>
                        </li>
                    <?php endif;?>
                    
                    <?php if(count($other_services)):?>                           
                    <li>
                        <a href="#">Other Services</a>
                        <ul>
                            <?php $services = url_for("product/index?page=1");?>
                            <?php foreach($other_services as $product): /* @var $product product */?>  
                                <?php if(!isset($subscribed[$product->getId()])):?>
                                    <li>
                                        <a href="<?php echo $services;?>"><?php echo $product->getName();?></a>
                                    </li>
                                 <?php endif;?>   
                            <?php endforeach;?>
                        </ul>
                    </li>
                    <?php endif;?>
                    
                    <li><a href="<?php echo url_for("@support_ticket") ?>">Ask the Expert</a></li>
                    <li><a href="<?php echo public_path("index.php/default/contact") ?>" target="_blank">General Query</a></li>
                    
                    <!--<li><a href="#">Blog</a></li>-->
                    
                    <?php if($sf_user->isAuthenticated()):?>
                        <li><a href="<?php echo url_for("@member") ?>">My Profile</a></li>						
                    <?php endif;?>
                </ul>
            </div>
            <?php else:?>
                <ul class="menu">
                    <li><a href="<?php echo public_path("index.php");?>">Home</a></li>                    
                    <li><a href="<?php echo public_path("index.php/content/aboutUs");?>">About Us</a></li>
                    <li><a href="<?php echo public_path("index.php/content/services");?>">Services</a></li>                    
                    <li><a title="Frequently asked questions" href="<?php echo public_path("index.php/faq/index") ?>">FAQs</a></li>
                    <li><a href="<?php echo public_path("index.php/newsnevent/index");?>">News &amp; Events</a></li>
                    <!--<li><a href="#">Blog</a></li>-->						
                    <li><a href="<?php echo public_path("index.php/default/contact");?>">Contact Us</a></li>
                </ul>                
            <?php endif;?>
