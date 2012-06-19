<?php

/**
 * groupUser actions.
 *
 * @package    gpol
 * @subpackage groupUser
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class groupUserActions extends sfActions
{
	public function executeIndex(sfWebRequest $request)
	{
		$this->group_users = Doctrine_Core::getTable('groupUser')
						->createQuery('a')
						->where('a.id >= 0')
						->execute();
	}

	public function executeNew(sfWebRequest $request)
	{
		$this->users= array();
		$this->form = new groupUserForm();

		$this->allUsers = Doctrine_Core::getTable('user')
						->createQuery('a')
						->execute();
	}

	public function executeCreate(sfWebRequest $request)
	{
		$this->forward404Unless($request->isMethod(sfRequest::POST));

		$this->form = new groupUserForm();

		$this->processForm($request, $this->form);

		$this->setTemplate('new');
	}

	public function executeEdit(sfWebRequest $request)
	{
		$this->forward404Unless($group_user = Doctrine_Core::getTable('groupUser')->find(array($request->getParameter('id'))), sprintf('Object group_user does not exist (%s).', $request->getParameter('id')));
		$this->form = new groupUserForm($group_user);

		$this->allUsers = Doctrine_Core::getTable('user')
						->createQuery('a')
						->execute();

		$group_user = Doctrine_Core::getTable('groupUser')->find(array($request->getParameter('id')));
		$this->users= $group_user->getUsers();
	}

	public function executeUpdate(sfWebRequest $request)
	{
		$this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
		$this->forward404Unless($group_user = Doctrine_Core::getTable('groupUser')->find(array($request->getParameter('id'))), sprintf('Object group_user does not exist (%s).', $request->getParameter('id')));
		$this->form = new groupUserForm($group_user);

		$this->processForm($request, $this->form);
		$this->allUsers = Doctrine_Core::getTable('user')
								->createQuery('a')
								->execute();

				$group_user = Doctrine_Core::getTable('groupUser')->find(array($request->getParameter('id')));
				$this->users= $group_user->getUsers();
		$this->setTemplate('edit');
	}

	public function executeDelete(sfWebRequest $request)
	{
		$request->checkCSRFProtection();

		$this->forward404Unless($group_user = Doctrine_Core::getTable('groupUser')->find(array($request->getParameter('id'))), sprintf('Object group_user does not exist (%s).', $request->getParameter('id')));
		$group_user->delete();

		$this->redirect('groupUser/index');
	}

	protected function processForm(sfWebRequest $request, sfForm $form)
	{
		$form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
		if ($form->isValid())
		{
			$group_user = $form->save();

			$usersId = $request->getParameter('user');
			$group_user->removeMembers();
			foreach($usersId as $userId){
				$group_user->addUser($userId);
			}
			$group_user->save();
			$this->redirect('groupUser/edit?id='.$group_user->getId());
		}
	}
}
