<?php

require_once dirname(__FILE__).'/../lib/question_bankGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/question_bankGeneratorHelper.class.php';

/**
 * question_bank actions.
 *
 * @package    BestBuddies
 * @subpackage question_bank
 * @author     Anvaya Technologies
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class question_bankActions extends autoQuestion_bankActions
{
    public function executeAddOptionsRow(sfWebRequest $request)
    {
        $id = $request->getParameter('id', false);
        if(!$id)
        {
            $qb = new question_bank();
        }
        else
            $qb = Doctrine::getTable('question_bank')
                    ->find($id);
        
        $this->form = new question_bankForm($qb);
        
        $num = $request->getParameter('num');
        
        $subform = $this->form->getEmbeddedForm("options");
        
        /* @var $subform questionBankOptionsCollectionForm */
        $detail  = $subform->addDetailRow($num);
        
        if(!$detail)
        {
            $response = $this->getResponse();
            $response->setStatusCode(400, "Invalid");
            return sfView::NONE;
        }
        
        $this->form->embedForm('options', $subform);

        return $this->renderPartial("option",array("item"=>$this->form["options"][$num] ,"key"=>$num));
    }
    
    public function executePickList(sfWebRequest $request)
    {                     
        $this->grid_content = sfDatagrid::renderDirect('product', 'question_bank','PickListGrid', array());
        //$this->setLayout("popup");        
    }
  
    public function executePickListGrid(sfWebRequest $request)
    {        
        #sfContext::getInstance()->getConfiguration()->loadHelpers(array('Tag', 'Url', 'jQuery','Url','Asset','Date')) ;
        sfContext::getInstance()->getConfiguration()->loadHelpers(array('Tag', 'jQuery', 'Url','Asset','Date')) ;
     
        $category_id = $request->getParameter('category_id',false);                
                
        $query = question_bankTable::getInstance()->getPickListQuery($category_id);               
        
        $grid = new sfDatagridDoctrine("product", "question_bank", $query,"qb");
        $grid->renderSearch(true);

        $grid->setColumns(
                    array(
                     'id'=>'id',                        
                     'question_text'=>'Text',
                     'category_id'=>'Category',
                     'answer_type'=>'Answer Type',                     
                     )
               );
        
        $column_filters = array(                            
                            'category_id'=>'FOREIGN',
                            'answer_type'=>'NOTYPE',
                            'id'=>'NOTYPE',                            
                            );
        
        $grid->setColumnOption("category_id", array("class_for_foreign"=>"question_category") );
        
        $grid->setColumnsFilters($column_filters);        
     
        $grid->setDefaultSortingColumn('question_text', 'asc');

        $p = $grid->prepare('doSelect','doCount');

        $values = array();

        foreach($p->getResults() as $item)
        {
             /* @var $item question_bank */
            $values[] = array(
                                $item->getId(),
                                $item->getQuestionText(),
                                $item->getQuestionCategory()->__toString(),
                                $item->getAnswerTypeName()
                             );
        }

        try
        {
            //$old_error = error_reporting(0);
            //$grid->setRowAction('customer/edit?id=', 'id');
            $content = $grid->getContent($values, array('grid','grid'));
            //error_reporting($old_error);
        }catch(Exception $ex) {}

        //$response = $this->getResponse();
        //$response->removeJavascript("/sfJqueryReloadedPlugin/js/jquery-1.3.2.min.js");
        
        $this->getResponse()->setContent($content);
        return sfView::NONE;
  } 
}
