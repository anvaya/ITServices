<?php

/**
 * member_subscription
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    BestBuddies
 * @subpackage model
 * @author     Anvaya Technologies
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class member_subscription extends Basemember_subscription
{
    public function setUp() 
    {
        parent::setUp();
        $this->addListener(new member_subscriptionListener());
    }
}