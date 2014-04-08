<?php
/**
 * Description of components
 *
 * @author Mrugendra Bhure
 */
class productComponents extends sfComponents
{
    public function executeBuyList()
    {
        $user_id = $this->getUser()->getGuardUser()->getId();
        $member  = memberTable::getInstance()->find($user_id);        
        
        $category_id = $this->getVar('category_id');// getRequestParameter("category_id");
        
        $product_list = $member->getProductList($category_id);
        
        $query = productTable::getInstance()
                        ->createQuery('p')                        
                        ->addWhere('p.price > 0')
                        ->addWhere('p.expired is null or p.expired = 0')
                        ->orderBy('p.category_id, p.name');                        
        
        if($category_id)
        {
            $query->addWhere('p.category_id = ?', $category_id);
        }
        
        if(count($product_list))
        {
            $query->whereIn('id', array_keys($product_list) , true);
        }
        
        $this->products = $query->execute();
    }
            
}

?>