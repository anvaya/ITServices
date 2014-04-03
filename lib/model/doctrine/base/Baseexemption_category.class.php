<?php

/**
 * Baseexemption_category
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property Doctrine_Collection $itr_exemption
 * 
 * @method Doctrine_Collection getItrExemption()  Returns the current record's "itr_exemption" collection
 * @method exemption_category  setItrExemption()  Sets the current record's "itr_exemption" collection
 * 
 * @package    BestBuddies
 * @subpackage model
 * @author     Anvaya Technologies
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class Baseexemption_category extends type_info
{
    public function setUp()
    {
        parent::setUp();
        $this->hasMany('itr_exemption', array(
             'local' => 'id',
             'foreign' => 'category_id'));
    }
}