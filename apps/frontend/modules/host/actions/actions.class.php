<?php

/**
 * host actions.
 *
 * @package    gpol
 * @subpackage host
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class hostActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->hosts = Doctrine_Core::getTable('host')
      ->createQuery('a')
      ->execute();
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = new hostForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST));

    $this->form = new hostForm();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($host = Doctrine_Core::getTable('host')->find(array($request->getParameter('id'))), sprintf('Object host does not exist (%s).', $request->getParameter('id')));
    $this->form = new hostForm($host);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($host = Doctrine_Core::getTable('host')->find(array($request->getParameter('id'))), sprintf('Object host does not exist (%s).', $request->getParameter('id')));
    $this->form = new hostForm($host);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->forward404Unless($host = Doctrine_Core::getTable('host')->find(array($request->getParameter('id'))), sprintf('Object host does not exist (%s).', $request->getParameter('id')));
    $host->delete();

    $this->redirect('host/index');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $host = $form->save();

      $this->redirect('host/edit?id='.$host->getId());
    }
  }
}
