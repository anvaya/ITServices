<?php

require_once dirname(__FILE__).'/../lib/form_questionGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/form_questionGeneratorHelper.class.php';

/**
 * form_question actions.
 *
 * @package    BestBuddies
 * @subpackage form_question
 * @author     Anvaya Technologies
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class form_questionActions extends autoForm_questionActions
{
    public function executeAddOptionsRow(sfWebRequest $request)
    {
        $id = $request->getParameter('id', false);
        if(!$id)
        {
            $qb = new form_question();
        }
        else
            $qb = Doctrine::getTable('form_question')
                    ->find($id);
        
        $this->form = new form_questionForm($qb);
        
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
}
