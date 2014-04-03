<?php

/**
 * newsnevent actions.
 *
 * @package    BestBuddies
 * @subpackage newsnevent
 * @author     Anvaya Technologies
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class newsneventActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->newsnevents = Doctrine_Core::getTable('newsnevent')
      ->createQuery('a')
      ->addOrderBy('a.event_date desc')
      ->limit(10)
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
      $this->forward404();
    $this->form = new newsneventForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
      $this->forward404();
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new newsneventForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
      $this->forward404();
    $this->forward404Unless($newsnevent = Doctrine_Core::getTable('newsnevent')->find(array($request->getParameter('id'))), sprintf('Object newsnevent does not exist (%s).', $request->getParameter('id')));
    $this->form = new newsneventForm($newsnevent);
  }

  public function executeUpdate(sfWebRequest $request)
  {
      $this->forward404();
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($newsnevent = Doctrine_Core::getTable('newsnevent')->find(array($request->getParameter('id'))), sprintf('Object newsnevent does not exist (%s).', $request->getParameter('id')));
    $this->form = new newsneventForm($newsnevent);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
      $this->forward404();
    $request->checkCSRFProtection();

    $this->forward404Unless($newsnevent = Doctrine_Core::getTable('newsnevent')->find(array($request->getParameter('id'))), sprintf('Object newsnevent does not exist (%s).', $request->getParameter('id')));
    $newsnevent->delete();

    $this->redirect('newsnevent/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
      $this->forward404();
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $newsnevent = $form->save();

      $this->redirect('newsnevent/edit?id='.$newsnevent->getId());
    }
  }
}
