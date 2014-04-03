<?php

require_once(sfConfig::get('sf_lib_dir')."/vendor/anvaya/utils.php");

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
    #$this->forward('question', 'index');
      $data = file_get_contents(sfConfig::get('sf_log_dir')."/reminder.html");
      send_email("John", "mrugendra999@yahoo.com", "Income Tax Return Submission Reminder", $data);      
  }
  
  public function executeTicketImport(sfWebRequest $request)
  {
      chdir(sfConfig::get('sf_root_dir')); // Trick plugin into thinking you are in a project directory
      $task = new ticketImportTask( $this->getContext()->getEventDispatcher(), new sfFormatter() ); //sfMyVerySpecialTask($this->dispatcher, new sfFormatter());
      $task->run();
  }
}
