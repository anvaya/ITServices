<?php
/**
 * Collection of Options for the question bank - Subform for the question bank form.
 *
 * @author Mrugendra Bhure
 */
class ItroneSubCollectionForm extends sfForm
{
    const MASTER_MODEL = "submission";
    
    public function configure() 
    {
        if(!$master = $this->getOption(self::MASTER_MODEL))
        {
            throw new InvalidArgumentException('You must provide a '.self::MASTER_MODEL.' object');
        }
        
        $details = array();
        /* @var $master submission */
        if($master->getId()>0)
        {
            $details = $master->getSubmissionInner();
        }
        
        $count = 0;
        foreach($details as $key=>$value)
        {
            $form = new ItroneSubForm($value);
            $this->embedForm($key, $form);
            $count++;
        }
        
        for($i=$count; $i<($count+1); $i++)
        {
            $key=$i;
            $value = new submission_inner();
            $value->setSubmission($master);
            $form = new ItroneSubForm($value);
            $this->embedForm($key, $form);
        }
        
        parent::configure();
    }

    public function addDetailRow($key)
    {
        $detail = new submission_inner();
        $master = $this->getOption(self::MASTER_MODEL);
        $detail->setSubmission($master);

        $form = new ItroneSubForm($detail);

        $this->embedForm($key, $form);
        return $this->embeddedForms[$key];
    }
}

?>