<?php

/**
 * gpol actions.
 *
 * @package    gpol
 * @subpackage gpol
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class gpolActions extends sfActions
{
	private function getAllMembers(){
		$arrays= array();
		$arrays['hosts'] = Doctrine_Core::getTable('host')
								->createQuery('a')
								->execute();
		$arrays['users']  = Doctrine_Core::getTable('user')
								->createQuery('a')
								->execute();
		$arrays['groupHosts']  = Doctrine_Core::getTable('groupHost')
								->createQuery('a')
								->execute();
		$arrays['groupUsers'] = Doctrine_Core::getTable('groupUser')
								->createQuery('a')
								->execute();

		return $arrays;
	}

	public function executeIndex(sfWebRequest $request)
	{
		$this->gpols = Doctrine_Core::getTable('gpol')
						->createQuery('a')
						->execute();
	}

	public function executeNew(sfWebRequest $request)
	{
		$this->form = new gpolForm();
		$this->data = $this->getAllMembers();
		$this->linkedData = array();
	}

	public function executeCreate(sfWebRequest $request)
	{
		$this->forward404Unless($request->isMethod(sfRequest::POST));

		$this->form = new gpolForm();

		$this->processForm($request, $this->form);

		$this->setTemplate('new');
	}

	public function executeEdit(sfWebRequest $request)
	{
		$this->forward404Unless($gpol = Doctrine_Core::getTable('gpol')->find(array($request->getParameter('id'))), sprintf('Object gpol does not exist (%s).', $request->getParameter('id')));
		$this->form = new gpolForm($gpol);
		$this->data = $this->getAllMembers();
		$this->linkedData = $gpol->getLinkedElements();
	}

	public function executeUpdate(sfWebRequest $request)
	{
		$this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
		$this->forward404Unless($gpol = Doctrine_Core::getTable('gpol')->find(array($request->getParameter('id'))), sprintf('Object gpol does not exist (%s).', $request->getParameter('id')));
		$this->form = new gpolForm($gpol);

		$this->processForm($request, $this->form);

		$this->data = $this->getAllMembers();
		$this->linkedData = $gpol->getLinkedElements();
		$this->setTemplate('edit');
	}

	public function executeDelete(sfWebRequest $request)
	{
		$request->checkCSRFProtection();

		$this->forward404Unless($gpol = Doctrine_Core::getTable('gpol')->find(array($request->getParameter('id'))), sprintf('Object gpol does not exist (%s).', $request->getParameter('id')));
		$gpol->delete();

		$this->redirect('gpol/index');
	}

	protected function processForm(sfWebRequest $request, sfForm $form)
	{
		$form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
		if ($form->isValid())
		{
			$gpol = $form->save();
			$gpol->removeAllLinks();
			$users = $request->getParameter('user');
			foreach($users as $userid){
				$gpol->addUserLink($userid);
			}
			$hosts = $request->getParameter('host');
			foreach($hosts as $hostid){
				$gpol->addHostLink($hostid);
			}
			$groupusers = $request->getParameter('groupUser');
			foreach($groupusers as $groupuserid){
				$gpol->addGroupUserLink($groupuserid);
			}
			$grouphosts = $request->getParameter('groupHost');
			foreach($grouphosts as $grouphostid){
				$gpol->addGroupHostLink($grouphostid);
			}
			$this->redirect('gpol/edit?id='.$gpol->getId());
		}
	}
}
