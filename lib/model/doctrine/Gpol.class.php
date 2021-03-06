<?php

/**
 * Gpol
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 *
 * @package    gpol
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Gpol extends BaseGpol
{
	static $type = array(1=>'BOOT',2=>'LOGIN');

	function __toString(){
		return $this->name;
	}

 function getTypeName(){
				return self::$type[$this->getType()];
	}

	static function getTypeId($name){
		$name=strtoupper($name);
		foreach(self::$type as $key => $t){
			if($t == $name)
				return $key ;
		}
		return false;
	}

	function removeAllLinks(){
		$links = Doctrine_Core::getTable('LinkGpolUser')
						->createQuery('a')
						->delete()
						->where( 'a.gpol_id = ?',$this->getId())
						->execute();
		$links = Doctrine_Core::getTable('LinkGpolHost')
						->createQuery('a')
						->delete()
						->where( 'a.gpol_id = ?',$this->getId())
						->execute();
		$links = Doctrine_Core::getTable('LinkGpolGroupUser')
						->createQuery('a')
						->delete()
						->where( 'a.gpol_id = ?',$this->getId())
						->execute();
		$links = Doctrine_Core::getTable('LinkGpolGroupHost')
						->createQuery('a')
						->delete()
						->where( 'a.gpol_id = ?',$this->getId())
						->execute();
	}
	function addUserLink($user){
		$link = new LinkGpolUser();
		$link->setGpolId($this->id);
		$link->setUserId($user);
		$link->save();
	}
	function addHostLink( $host){
		$link = new LinkGpolHost();
		$link->setGpolId($this->id);
		$link->setHostId($host);
		$link->save();
	}
	function addGroupUserLink($groupUser){
		$link = new LinkGpolGroupUser();
		$link->setGpolId($this->id);
		$link->setGroupUserId($groupUser);
		$link->save();
	}
	function addGroupHostLink($groupHost){
		$link = new LinkGpolGroupHost();
		$link->setGpolId($this->id);
		$link->setGroupHostId($groupHost);
		$link->save();
	}

	function getLinkedElements(){
		$hosts = Doctrine_Core::getTable('Host')
						->createQuery('a')
						->leftJoin('a.LinkGpolHost b')
						->where( 'b.gpol_id = ?',$this->getId())
						->execute();
		$users = Doctrine_Core::getTable('User')
						->createQuery('a')
						->leftJoin('a.LinkGpolUser b')
						->where( 'b.gpol_id = ?',$this->getId())
						->execute();
		$groupHosts = Doctrine_Core::getTable('GroupHost')
						->createQuery('a')
						->leftJoin('a.LinkGpolGroupHost b')
						->where( 'b.gpol_id = ?',$this->getId())
						->execute();
		$groupUsers = Doctrine_Core::getTable('GroupUser')
						->createQuery('a')
						->leftJoin('a.LinkGpolGroupUser b')
						->where( 'b.gpol_id = ?',$this->getId())
						->execute();
		return array('hosts'=>$hosts,'users'=>$users,'groupHost'=>$groupHosts,'groupUser'=>$groupUsers);
	}


}
