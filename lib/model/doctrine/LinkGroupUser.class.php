<?php

/**
 * LinkGroupUser
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    gpol
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class LinkGroupUser extends BaseLinkGroupUser
{
	function addUser($userid){
		$grpUser = new LinkGroupUser();
		$grpUser->setUserId($userid);
		$grpUser->setGroupUserId($this->getId());
		$grpUser->save();
		return true;
	}


	function countUser(){
		$users = Doctrine_Core::getTable('LinkGroupUser')
						->createQuery('a')
						->where( 'a.group_user_id = ?',$this->getId())
						->execute();
		return count($users);
	}

	function getUsers(){
		$users = Doctrine_Core::getTable('User')
						->createQuery('a')
						->leftJoin('a.LinkGroupUser b')
						->where( 'b.group_user_id = ?',$this->getId())
						->execute();
		return $users;
	}

	function removeMembers(){
		$users = $users = Doctrine_Core::getTable('LinkGroupUser')
								->createQuery('a')
								->where( 'a.group_user_id = ?',$this->getId())
								->execute();
		foreach($users as $tmpuser){
			$tmpuser->delete();
		}
	}
}
