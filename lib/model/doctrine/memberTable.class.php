<?php

/**
 * memberTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class memberTable extends sfGuardUserTable
{
    /**
     * Returns an instance of this class.
     *
     * @return object memberTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('member');
    }
    
    /**
     * Returns a list of memory choices from the asset record for autocomplete.     
     * @param string $match Matching string
     * @param int    $limit How many records to fetch 
     * @return array Returns array filled with memory items, blank array if no items found.
    */
    public function getListForAjax($match="", $limit=5, $active=false)
    {  
        $q = Doctrine_Manager::getInstance()->getConnection("doctrine");
        $i = 0;
        
        $query   = $this->createQuery('s')
              ->addWhere('(s.first_name like ?) OR (s.last_name like ?)', array($match.'%',$match.'%'))
              ->orderBy('s.first_name, s.last_name')
              ->select('s.id, s.first_name, s.last_name')                
              ->limit($limit);
        
        if($active !== false)
        {
            if($active=='0')
            {
                $query->addWhere('s.is_active IS NULL or s.is_active = 0');
            }
            else
            {
                $query->addWhere('s.is_active = 1');
            }
        }
        
        $results = $query->fetchArray();  
              
        $out = array();
        $i=  0;
        $added = array();
        
        foreach($results as $row)
        {
            $added[$row['id']] = true;
            $out[] = array("value"=>$row['id'], "label"=>$row['first_name'].' '.$row['last_name']);
            $i++;
        }               

        if($i<$limit)
        {
            $results = $this->createQuery('s')
              ->addWhere('(s.first_name like ?) OR (s.last_name like ?)', array('%'.$match.'%','%'.$match.'%'))
              ->orderBy('s.first_name, s.last_name')
              ->select('s.id, s.first_name, s.last_name')  
              ->limit($limit)
              ->fetchArray();              
            
            foreach($results as $row)
            {        
               if(isset($added[$row['id']])) continue;
               if($i==$limit) break;
               $out[] = array("value"=>$row['id'], "label"=>$row['first_name'].' '.$row['last_name']);
               $i++;                
            }
        }                   
           
        return $out;    
    }
}