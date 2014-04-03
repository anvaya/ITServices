<?php
/**
 * Description of components
 *
 * @author Mrugendra Bhure
 */
class faqComponents extends sfComponent
{
    public function execute($request) 
    {
        parent::execute($request);
    }
    
    public function executeContent()
    {
        $slug = $this->getVar('slug');
        $content = Doctrine::getTable('content')->findOneBySlug($slug);        
        
        /* @var $content content */
        $this->content = $content->getContent();
        
        if(!$this->content)
            return sfView::NONE;        
    }
}

?>