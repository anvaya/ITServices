<div class="wrapper1">    
        <h2 class="title" style="text-align: left;"><?php echo "Contact Us" ?></h4>        
        
        <table style="padding-bottom: 20px;">
            <tr>
                <td valign="top">
                    <div class="entry">
                            <h5>NRI Services @ Groworth</h5>
                            <p>Email: <a href="mailto:nrihelp@groworth.in">nrihelp@groworth.in</a></p>
                            <p>
                                    N-7, Abhinav Shilp Apartments ,<br>
                                    Laxmi Nagar,<br>
                                    Nagpur 440022<br>	
                            </p>
                    </div>
                </td>
                <td style="border-left: 4px solid #CCC; padding-left: 15px;">
                    <?php if($sf_user->hasFlash('error')):?>                    
                        <div class="error"><?php echo $sf_user->getFlash('error'); ?></div>
                    <?php elseif($sf_user->hasFlash('notice')):?>                            
                        <div class="notice"><?php echo $sf_user->getFlash('notice'); ?></div>
                    <?php endif;?>
                            
                    <form action="<?php echo url_for('default/contact') ?>" method="post">    
                    <?php foreach($form as $key => $field ):?>
                       <?php if($field->isHidden() || $key == "captcha") continue; ?>
                       <div class="sf_admin_form_row sf_admin_text">                        
                        <div>
                            <?php echo $field->renderLabel(); ?>
                            <?php echo $field->renderError(); ?>
                            <div class="content">
                                <?php echo $field->render(); ?>                            
                            </div>
                       </div>
                    </div>
                    <?php endforeach;?>
                     
                    <div class="sf_admin_form_row sf_admin_text">  
                        <?php if($form['captcha']->hasError()):?>
                            <?php echo $form['captcha']->renderError() ?>
                        <?php endif;?>
                        <div>                            
                            <label>Please enter the characters shown below</label> <span class="required">*</span>
                            <div class="content">
                                 <?php echo $form['captcha']->render(array("rows"=>10,"cols"=>40)); ?> 
                            </div>
                        </div>                                          
                        
                          <div class="sf_admin_form_row sf_admin_text">
                            <div>
                              <label>&nbsp;</label>
                              <div class="content">
                                <?php echo $form->renderHiddenFields(); ?>
                                <input type="submit" class="green-btn" name="send" value="Send Query"/>
                              </div>
                            </div>
                          </div>
                    </form>
                </td>
                
            </tr>
        </table>

    
        <?php echo html_entity_decode($content); ?>
    

    </div>
</div>
                