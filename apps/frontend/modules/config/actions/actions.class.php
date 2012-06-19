<?php

/**
 * config actions.
 *
 * @package    gpol
 * @subpackage config
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class configActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->configs = Doctrine_Core::getTable('config')
      ->createQuery('a')
      ->execute();
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->forward404Unless($config = Doctrine_Core::getTable('config')->find(array($request->getParameter('id'))), sprintf('Object config does not exist (%s).', $request->getParameter('id')));
    $this->form = new configForm($config);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($config = Doctrine_Core::getTable('config')->find(array($request->getParameter('id'))), sprintf('Object config does not exist (%s).', $request->getParameter('id')));
    $this->form = new configForm($config);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }


  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $config = $form->save();

      $this->redirect('config/edit?id='.$config->getId());
    }
  }
}
