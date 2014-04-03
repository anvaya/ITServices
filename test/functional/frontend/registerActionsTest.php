<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new sfTestFunctional(new sfBrowser());

$browser->
  get('/guard/register')->

  with('request')->begin()->
    isParameter('module', 'sfGuardRegister')->
    isParameter('action', 'index')->
  end()->

  with('response')->begin()->
    isStatusCode(200)->    
    checkElement('#main_content h1:contains("Register With Us")', true )->
    click('input[type="submit"]', array('sf_guard_user'=>array('username'=>'anvaya'.date('Ymdhis')           
                    ,'email_address'=>'anvaya'.date('Ymdhis').'@none.com'
                    ,'password'=>'123457'
                    ,'password_again'=>'123457'
                    ,'first_name'=>'Mrugendra'
                    ,'middle_name'=>'R'
                    ,'last_name'=>'Bhure'
                    ,'last_name'=>'Bhure'
                    ,'dob'=>array('day'=>'24','month'=>'12','year'=>'1982')
                    ,'subscription'=>array('subscription_id'=>1)
                ))                    
            )->    
  end()->
        
 with('response')->begin()->
        isStatusCode(302)->
        checkElement('#main_content h1:contains("Thank you !")', true )->
        end()
;

