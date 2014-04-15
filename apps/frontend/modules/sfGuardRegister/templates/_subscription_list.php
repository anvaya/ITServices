<div>             
             <div class="content" >
                 <table id="subscriptions" cellspacing="0">
                     <thead>
                         <tr>
                             <th align="left">Title</th>
                             <th>Features</th>
                             <th>Price</th>
                         </tr>
                     </thead>
                     <tbody>
                         <?php foreach($subscriptions as $index=>$subscription): /* @var $subscription subscription */?>
                         <tr>
                             <td>
                                 <input type="radio" <?php if($index==0):?>checked<?php endif;?>  name="sf_guard_user[subscription][subscription_id]" id="user_subscription_subscription_id_<?php echo $subscription->getId() ?>" value="<?php echo $subscription->getId() ?>" />
                                 <label for="user_subscription_subscription_id_<?php echo $subscription->getId() ?>"><?php echo $subscription->getName();?></label>
                             </td>
                             <td>
                                 <ul class="product_list">
                                    <?php 
                                          $products = $subscription->getSubscriptionProduct();
                                          foreach($products as $product): /* @var $product product*/
                                    ?>
                                     <li>
                                         <?php echo $product->getProduct()->getName();?>
                                     </li>
                                     <?php endforeach;?>                                     
                                 </ul>
                             </td>
                             <td><?php echo $subscription->getCurrency()." ".$subscription->getPrice(); ?></td>
                         </tr>
                         <?php endforeach;?>
                     </tbody>                         
                 </table>
             </div>
           </div>