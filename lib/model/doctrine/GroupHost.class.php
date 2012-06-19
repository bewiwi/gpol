<?php

/**
 * GroupHost
 *
 * This class has been auto-generated by the Doctrine ORM Framework
 *
 * @package    gpol
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class GroupHost extends BaseGroupHost
{

	static function getGroupHostById($id){
		$grouphost = Doctrine_Core::getTable('GroupHost')
						->createQuery('a')
						->where( 'a.id = ?',$id)
						->execute();
		if(isset($grouphost[0]))
			return $grouphost[0];
		return false;
	}


	function addHost($hostid){
		$grpHost = new LinkGroupHost();
		$grpHost->setHostId($hostid);
		$grpHost->setGroupHostId($this->getId());
		$grpHost->save();
		return true;
	}


	function countHost(){
		$hosts = Doctrine_Core::getTable('LinkGroupHost')
						->createQuery('a')
						->where( 'a.group_host_id = ?',$this->getId())
						->execute();
		return count($hosts);
	}

	function getHosts(){
		$hosts = Doctrine_Core::getTable('Host')
						->createQuery('a')
						->leftJoin('a.LinkGroupHost b')
						->where( 'b.group_host_id = ?',$this->getId())
						->execute();
		return $hosts;
	}

	function removeMembers(){
		$hosts = Doctrine_Core::getTable('LinkGroupHost')
						->createQuery('a')
						->delete()
						->where( 'a.group_host_id = ?',$this->getId())
						->execute();

	}

	function isMember(Host $host){
		foreach($this->getHosts() as $mhost){
			if($mhost->getId() == $host->getId()){
				return true;
			}
		}
		return false;
	}

}