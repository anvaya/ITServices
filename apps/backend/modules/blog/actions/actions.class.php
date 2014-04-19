<?php

require_once dirname(__FILE__).'/../lib/blogGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/blogGeneratorHelper.class.php';

/**
 * blog actions.
 *
 * @package    BestBuddies
 * @subpackage blog
 * @author     Anvaya Technologies
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class blogActions extends autoBlogActions
{
  public function executeSendAsNewsletter(sfWebRequest $request)
  {
    $this->blog = $this->getRoute()->getObject();
    $this->forward404Unless($this->blog);
    $this->setLayout('popup');
  }
  public function executeSendNewsletter(sfWebRequest $request)
  {
    $msg = "";
    if($request->getMethod()==sfWebRequest::POST)
    {
      $this->blog = Doctrine_Core::getTable('blog')->find($request->getParameter('blog_id'));
      $this->forward404Unless($this->blog);
      $sendas = $request->getParameter('sendas');
      if($sendas == 1 || $sendas == 2)
      {
        $arr['title'] = $this->blog->getTitle();
        $arr['image'] = $this->blog->getImage();
        $arr['created_by'] = "";
        if ($this->blog->getAuthorId())
        {
              $user = Doctrine_Core::getTable('sfGuardUser')->find($this->blog->getAuthorId());  
              if($user)
                $arr['created_by'] = $user->getUsername(). "(".$user->getFirstName()." ".$user->getLastName().")";
        }
        if($sendas == 1)
          $arr['body'] = $this->blog->getSummary();
        elseif($sendas == 2)
          $arr['body'] = $this->blog->getBlog();
        else
          $arr['body'] = "";
        //$admin_email = SettingsTable::getValue('admin_email');
        $admin_email = "admin@test.com";
        $email_body = get_partial("blog/sendasnewslatter_email_body", array("blog" => $arr));
        
        $subject  = "ITservices:: ".$this->blog->getTitle();
        // Additional headers
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: It Services <'.$admin_email.'>' . "\r\n";
        //$headers .= 'Cc: contact@anvayatech.com' . "\r\n";
        $headers .= 'Cc: keval23@gmail.com' . "\r\n";
        //$headers .= 'To: '. $member->getFirstName()."<". $member->getEmailAddress().">". "\r\n";
        $members = Doctrine_Core::getTable('member')->findAll();
        foreach($members as $member)
          $to = $member->getFirstName()."<". $member->getEmailAddress().">";
        
        //$result = @mail($to, $subject, $email_body, $headers);
        //if($result)
        {
          $msg ='Itr news letter send successfully';
        }
        //else
        {
          $this->logMessage("Itr news latter ".$arr['title']." not sent to member ".$member->getFirstName()." ".$member->getLastName(),'notice');
        } 
      }
      $msg ='Itr news letter send successfully';
      
    }
    $this->setLayout(FALSE);
    return $this->renderText($msg);

    //return $this->redirect('blog/sendAsNewsletter?id='.$request->getParameter('id'));
  }
}
