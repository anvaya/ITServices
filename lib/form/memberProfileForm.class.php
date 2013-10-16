<?php
/**
 * Description of memberProfileForm
 *
 * @author Mrugendra Bhure
 */
class memberProfileForm extends BasememberForm
{
    public function configure()
    {
        parent::configure();
        
        unset(
            $this['last_login'],
            $this['created_at'],
            $this['updated_at'],
            $this['salt'],
            $this['algorithm'],
            $this['groups_list'],
            $this['permissions_list'],
            $this['is_active'],
            $this['is_super_admin'],            
            $this['country'],
            $this['timezone'],
            $this['culture'],
            $this['is_member'],
            $this['member_type_id'],
            $this['application_id']
    );
        
        
        $this->widgetSchema['password'] = new sfWidgetFormInputPassword();        
        $this->validatorSchema['password']->setOption('required', false);
        $this->widgetSchema['password_again'] = new sfWidgetFormInputPassword();
        $this->validatorSchema['password_again'] = clone $this->validatorSchema['password'];

        $this->widgetSchema->moveField('password_again', 'after', 'password');

        $this->widgetSchema['password']->setAttribute('autocomplete','off');
        $this->widgetSchema['password_again']->setAttribute('autocomplete','off');
        
        $member = $this->getObject();
        $submission_id = $member->getApplication()->getSubmissionId();
        
        /* @var $member member */
        $submission = Doctrine::getTable('submission')
                          ->find($submission_id);
        
        $dataCollectionForm = new submissionDataCollectionForm(array(), array("submission"=>$submission,"question_ids"=>array(36,37,39,38) ) );
        $this->embedForm("emergency_data", $dataCollectionForm);
        
        $dataCollectionForm = new submissionDataCollectionForm(array(), array("submission"=>$submission,"question_ids"=>array(16,17,18,19,20,21,10) ) );
        $this->embedForm("address_data", $dataCollectionForm);
        
        $dataCollectionForm = new submissionDataCollectionForm(array(), array("submission"=>$submission,"question_ids"=>array(52,53,54,55,56,57) ) );
        $this->embedForm("parent_data", $dataCollectionForm);
        
        $this->mergePostValidator(new sfValidatorSchemaCompare('password', sfValidatorSchemaCompare::EQUAL, 'password_again', array(), array('invalid' => 'The two passwords must be the same.')));
    }
}

?>