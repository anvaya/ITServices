<?php

/**
 * default actions.
 *
 * @package    BestBuddies
 * @subpackage default
 * @author     Anvaya Technologies
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class defaultActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    //$this->page = site_pageTable::getInstance()->findOneByTitle('Home');
  }
  
  public function executeContact(sfWebRequest $request)
  {
      $form = new contactusForm();
      
      if($request->getMethod()==sfWebRequest::POST)
      {
          $captcha = array(
            'recaptcha_challenge_field' => $request->getParameter('recaptcha_challenge_field'),
            'recaptcha_response_field'  => $request->getParameter('recaptcha_response_field'),);
            
          
          $form->bind(array_merge($request->getParameter($form->getName()), array('captcha' => $captcha)));
      
          //$form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
          
          if($form->isValid())
          {
              $sender_name = $form->getValue("sender_name");
              $sender_email = $form->getValue("sender_email");
              $message      =
                      "Name: ".$form->getValue("sender_name")."\n".
                      "Phone: ".$form->getValue("phone_number")."\n".
                      "Country: ".$form->getValue("country")."\n".
                      "City: ".$form->getValue("city")."\n".
                      "State: ".$form->getValue("state")."\n".
                      "Zip Code: ".$form->getValue("zip_code")."\n".
                      "Address1: ".$form->getValue("address1")."\n".
                      "Address2: ".$form->getValue("address2")."\n".
                      "Message: \n".
                      "=================================".
                      $form->getValue("message");
              
              $to      = 'contact@anvayatech.com';
              $subject = 'Contact Us: Growth Real Solutions';              
              $headers = 'From: '.$sender_name.'<'.$sender_email. ">\r\n" . 
                      "Cc: contact@anvayatech.com\r\n".
                    'X-Mailer: PHP/' . phpversion();

              mail($to, $subject, $message, $headers);
              $this->setTemplate('contactThanks');
          }
          else
          {
              $this->getUser()->setFlash('error','Your message could not be sent due to some errors.');
          }
      }   
      
      $content = site_pageTable::getInstance()
                    ->find(3);
      /* @var $content site_page */
      $this->content = $content->getPageContent();          
      
      
      $this->form = $form;
  }
  
  public function executeThankyou(sfWebRequest $request)
  {
      
  }
}
