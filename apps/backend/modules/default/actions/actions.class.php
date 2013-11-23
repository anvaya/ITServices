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
    #$this->forward('question', 'index');
  }
  
  public function executeTicketImport(sfWebRequest $request)
  {
      chdir(sfConfig::get('sf_root_dir')); // Trick plugin into thinking you are in a project directory
      $task = new ticketImportTask( $this->getContext()->getEventDispatcher(), new sfFormatter() ); //sfMyVerySpecialTask($this->dispatcher, new sfFormatter());
      $task->run();
  }
}
