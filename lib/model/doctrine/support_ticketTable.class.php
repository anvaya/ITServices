<?php

/**
 * support_ticketTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class support_ticketTable extends Doctrine_Table
{
    const STATUS_OPEN = 1;
    const STATUS_AWAITING_REPLY = 2;
    const STATUS_CLOSED = 3;
    const STATUS_CLOSED_REPAIR_CREATED = 4;
    
    /**
     * Returns an instance of this class.
     *
     * @return object support_ticketTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('support_ticket');
    }
    
    public function getCountByStatus($status= support_ticketTable::STATUS_OPEN, $assigned_to = false)
    {
        $query = $this->createQuery('t')
                ->addWhere('t.status = ?', $status);                
        
        if($assigned_to)
            $query->addWhere('t.assigned_to = ?', $assigned_to);
        
        return $query->count();
    }
    
    public function getMemberTicketList(Doctrine_Query $q)
    {
      $rootAlias = $q->getRootAlias();
      $q->andWhere('member_id = ?', sfContext::getInstance()->getUser()->getAttribute('user_id',null,'sfGuardSecurityUser'))
      ->orderBy('id DESC');
      return $q;
    }    
}