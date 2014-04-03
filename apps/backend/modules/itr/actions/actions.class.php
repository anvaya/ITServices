<?php

require_once dirname(__FILE__).'/../lib/itrGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/itrGeneratorHelper.class.php';
require_once sfConfig::get('sf_lib_dir').'/vendor/tcpdf/tcpdf.php';
/**
 * itr actions.
 *
 * @package    BestBuddies
 * @subpackage itr
 * @author     Anvaya Technologies
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class itrActions extends autoItrActions
{
	public function executeShow(sfWebRequest $request)
	{
	  $this->itr_submission = Doctrine::getTable('itr_submission')->find($request->getParameter('id'));
	  $this->forward404Unless($this->itr_submission);
	  $this->form = $this->configuration->getForm($this->itr_submission);
	}
        
        public function executeAsHtml(sfWebRequest $request)
        {
            $itr_submission = Doctrine::getTable('itr_submission')->find($request->getParameter('id'));
            $response = $this->getResponse();
            $path = $itr_submission->getPanNo()."_".$itr_submission->getLastName()."_".$itr_submission->getFirstName().".html";
            $response->setContentType('text/html');
            $response->setHttpHeader('Content-Disposition', 'attachment; filename="' . $path . '"');
            $this->setLayout(false);
            
            $this->itr_submission = $itr_submission;
            
        }
        
        public function executePdf(sfWebRequest $request)
        {
            
            $itr_submission = Doctrine::getTable('itr_submission')->find($request->getParameter('id'));
            
            $html_body      = $this->getPartial("asHtml" , array("itr_submission"=>$itr_submission));
            
            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

            // set document information
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('Groworth.in');
            //$pdf->SetTitle('TCPDF Example 006');
            $pdf->SetSubject('ITR Submission');
            //$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

            // set default header data
            //$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);
            //$pdf->setHeaderData($ln, $lw, $ht, $hs);
            // set header and footer fonts
            //$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
            //$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

            // set default monospaced font
            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

            //set margins

            $pdf->SetMargins(8, 0, 4);
            $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
            $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

            //set auto page breaks
            $pdf->SetAutoPageBreak(TRUE, 2);

            //set image scale factor
            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

            //set some language-dependent strings
            //$pdf->setLanguageArray($l);

            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);

            // ---------------------------------------------------------        
            // set font

            $pdf->SetFont('helvetica', '', 10);
            // add a page
            $pdf->AddPage();        

            $pdf->writeHTML($html_body, false, false, true, false, '');
            
            $path = $itr_submission->getPanNo()."_".$itr_submission->getLastName()."_".$itr_submission->getFirstName().".pdf";
            $response = $this->getResponse();
            $response->setContentType('application/pdf');
            $response->setHttpHeader('Content-Disposition', 'attachment; filename="' . $path . '"');
            $this->setLayout(false);
            
            /* @var $itr_submission itr_submission */
            $date_parts = explode("-", $itr_submission->getDob());
            $pwd = $itr_submission->getPanNo()."".$date_parts[2].$date_parts[1].$date_parts[0];
            $pdf->SetProtection(array('print', 'copy'), $pwd, null, 0, null);
            $pdf->Output($path, 'D');
            //$pdf->Output($path);
        }
        
        public function executeUpdateStatus(sfWebRequest $request)
	{
	  $this->itr_submission = Doctrine::getTable('itr_submission')->find($request->getParameter('id'));
	  $this->forward404Unless($this->itr_submission);
    
    $arr_status = array(
        0 => "Pending",
        1 => "Processing",
        2 => "Awaiting Information from customer",
        3 => "Processed Pending Filing",
        4 => "Return Filed"
    );
    $this->status_form = new sfForm();
    $this->status_form->setWidgets(array(
      'id'    => new sfWidgetFormInputHidden(array(),array('value'=> $request->getParameter('id'))),
      'status' => new sfWidgetFormChoice(array('choices' => $arr_status)),      
    ));
    $this->status_form->getWidgetSchema()->setNameFormat('status[%s]');

    if($request->isMethod('post'))
    {
      $this->getUser()->setFlash('notice', 'The status was updated successfully.');
      
      $frm = $request->getParameter('status');
      //print_r($frm);exit;
      if($frm['status'] == 1)
      {
          $member = $this->itr_submission->getMember();
          //mail send to customer
          $admin_email = SettingsTable::getValue('admin_email');
          $email_body = get_partial("itr/itrstatus_email_body", array("user" => $member, "itr_submission" => $this->itr_submission ));
          
          $subject  = "ITservices:: Your itr form in process";
          // Additional headers
          $headers  = 'MIME-Version: 1.0' . "\r\n";
          $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
          $headers .= 'From: It Services <'.$admin_email.'>' . "\r\n";
          //$headers .= 'Cc: contact@anvayatech.com' . "\r\n";
          $headers .= 'Cc: keval23@gmail.com' . "\r\n";
          //$headers .= 'To: '. $member->getFirstName()."<". $member->getEmailAddress().">". "\r\n";
          $to = $member->getFirstName()."<". $member->getEmailAddress().">";
          $result = @mail($to, $subject, $email_body, $headers);
          if($result)
          {
            $this->getUser()->setFlash('notice', 'Itr form  status was updated successfully');
          }
          else
          {
            $this->logMessage("Itr status update not sent to applicant member",'notice');
          } 

      }
      $this->itr_submission->setStatus($frm['status']);
      $this->itr_submission->save();
      //$this->redirect('@itr_submission');
    }
	}
  
	public function executeDuetax(sfWebRequest $request)
	{
	  $this->itr_submission = Doctrine::getTable('itr_submission')->find($request->getParameter('id'));
	  $this->forward404Unless($this->itr_submission);
    
    $member = $this->itr_submission->getMember();
    //mail send to customer
    $encryption_key = sfConfig::get('sf_mail_encryption_key');
    $itr_info = array($this->itr_submission->getId(), $this->itr_submission->getMemberId());
    $serialized  = serialize($itr_info);
    $encrypted   = RIJNDAEL_encrypt($serialized, $encryption_key);
    $link        = urlencode($encrypted);
    //echo $link;exit;
    $admin_email = SettingsTable::getValue('admin_email');
    echo $email_body = get_partial("itr/paymentnotification_email_body", array("user" => $member, "itr_submission" => $this->itr_submission, "link" => $link));
    exit;
    $subject  = "ITservices:: Your Tax payment reminder";
    // Additional headers
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= 'From: It Services <'.$admin_email.'>' . "\r\n";
    //$headers .= 'Cc: contact@anvayatech.com' . "\r\n";
    $headers .= 'Cc: keval23@gmail.com' . "\r\n";
    //$headers .= 'To: '. $member->getFirstName()."<". $member->getEmailAddress().">". "\r\n";
    $to = $member->getFirstName()."<". $member->getEmailAddress().">";
    $result = @mail($to, $subject, $email_body, $headers);
    if($result)
    {
      $this->getUser()->setFlash('notice', 'Itr form  status was updated successfully');
    }
    else
    {
      $this->logMessage("Itr payment mail not sent to applicant member",'notice');
    } 

    $this->redirect('@itr_submission');
	}
  
}
