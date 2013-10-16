<?php

/**
 * Description of profileDataEditForm
 *
 * @author Mrugendra Bhure
 */
class profileDataEditForm extends submission_dataForm
{
    public function configure()
    {
        parent::configure();
        
        $object = $this->getObject();
        
        /* @var $object submission_data */
        $question = $object->getFormQuestion();
        $this->widgetSchema['answser_text']->setLabel($question->getQuestionText());
        $this->widgetSchema['answser_text']->setAttribute('size',60);
        
        unset($this['question_id'],$this['selected_options'],$this['answer_files'],$this['submission_id']);
    }
}

?>