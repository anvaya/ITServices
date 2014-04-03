<?php
/**
 * Description of activateMemberForm
 *
 * @author Mrugendra Bhure
 */
class activateMemberForm extends sfForm
{
    public function configure() 
    {
        parent::configure();        
        $this->widgetSchema['member_name'] = new sfWidgetFormJQueryAutocompleter
                                                (
                                                    array
                                                    (
                                                        'url'   => url_for('@member_autocomplete'),
                                                        'config' => '{ width: 220,max: 20,highlight:false ,multiple: false,multipleSeparator: ",",scroll: true,scrollHeight: 300}'
                                                    )
                                                );
    }
}

?>