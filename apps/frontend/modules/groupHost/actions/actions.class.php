<?php

/**
 * groupHost actions.
 *
 * @package    gpol
 * @subpackage groupHost
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class groupHostActions extends sfActions
{
	public function executeIndex(sfWebRequest $request)
	{
		$this->group_hosts = Doctrine_Core::getTable('groupHost')
						->createQuery('a')
						->where('a.id >= 0')
						->execute();
	}

	public function executeNew(sfWebRequest $request)
	{
		$this->hosts= array();
		$this->form = new groupHostForm();

		$this->allHosts = Doctrine_Core::getTable('host')
						->createQuery('a')
						->execute();
	}

	public function executeCreate(sfWebRequest $request)
	{
		$this->forward404Unless($request->isMethod(sfRequest::POST));

		$this->form = new groupHostForm();

		$this->processForm($request, $this->form);

		$this->setTemplate('new');
	}

	public function executeEdit(sfWebRequest $request)
	{
		$this->forward404Unless($group_host = Doctrine_Core::getTable('groupHost')->find(array($request->getParameter('id'))), sprintf('Object group_host does not exist (%s).', $request->getParameter('id')));
		$this->form = new groupHostForm($group_host);

		$this->allHosts = Doctrine_Core::getTable('host')
						->createQuery('a')
						->execute();

		$group_host = Doctrine_Core::getTable('groupHost')->find(array($request->getParameter('id')));
		$this->hosts= $group_host->getHosts();
	}

	public function executeUpdate(sfWebRequest $request)
	{
		$this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
		$this->forward404Unless($group_host = Doctrine_Core::getTable('groupHost')->find(array($request->getParameter('id'))), sprintf('Object group_host does not exist (%s).', $request->getParameter('id')));
		$this->form = new groupHostForm($group_host);

		$this->processForm($request, $this->form);
		$this->allHosts = Doctrine_Core::getTable('host')
						->createQuery('a')
						->execute();

		$group_host = Doctrine_Core::getTable('groupHost')->find(array($request->getParameter('id')));
		$this->hosts= $group_host->getHosts();
		$this->setTemplate('edit');
	}

	public function executeDelete(sfWebRequest $request)
	{
		$request->checkCSRFProtection();

		$this->forward404Unless($group_host = Doctrine_Core::getTable('groupHost')->find(array($request->getParameter('id'))), sprintf('Object group_host does not exist (%s).', $request->getParameter('id')));
		$group_host->delete();

		$this->redirect('groupHost/index');
	}

	protected function processForm(sfWebRequest $request, sfForm $form)
	{
		$form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
		if ($form->isValid())
		{
			$group_host = $form->save();

			$hostsId = $request->getParameter('host');
			$group_host->removeMembers();
			foreach($hostsId as $hostId){
				$group_host->addHost($hostId);
			}
			$group_host->save();
			$this->redirect('groupHost/edit?id='.$group_host->getId());
		}
	}
}
