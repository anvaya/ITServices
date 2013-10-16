<?php
/**
 * Description of keyValuePairHydrator
 *
 * @author Mrugendra Bhure
 */
class csvHydrator extends Doctrine_Hydrator_Abstract
{
  public function hydrateResultSet($stmt)
  {
    $results = $stmt->fetchAll(Doctrine_Core::FETCH_NUM);
    $out = array();
    foreach ($results as $result)
    {      
      $out[] = $result[0];    
    } 
    return $out;
  }  
  
}
?>