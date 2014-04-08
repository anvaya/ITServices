<?php

/**
 * product actions.
 *
 * @package    BestBuddies
 * @subpackage product
 * @author     Anvaya Technologies
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class productActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $query = Doctrine_Core::getTable('product')
      ->createQuery('a')
      ->addWhere('a.expired is null or a.expired = 0');
      //->execute();
    //sfConfig::get('app_max_per_page')
    $this->products = new sfDoctrinePager('product', 1);
    $this->products->setQuery($query);
    $this->products->setPage($request->getParameter('page', 1));
    $this->products->init();
  }
  
  public function executeShow(sfWebRequest $request)
  {
    $this->product = Doctrine_Core::getTable('product')->find(array($request->getParameter('id')));
    $this->forward404Unless($this->product);
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($product = Doctrine_Core::getTable('product')->find(array($request->getParameter('id'))), sprintf('Object product does not exist (%s).', $request->getParameter('id')));
    $this->form = new productForm($product);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($product = Doctrine_Core::getTable('product')->find(array($request->getParameter('id'))), sprintf('Object product does not exist (%s).', $request->getParameter('id')));
    $this->form = new productForm($product);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $product = $form->save();

      $this->redirect('product/edit?id='.$product->getId());
    }
  }
}
