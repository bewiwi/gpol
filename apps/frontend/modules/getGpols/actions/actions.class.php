<?php

/**
 * getGpols actions.
 *
 * @package    gpol
 * @subpackage getGpols
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class getGpolsActions extends sfActions
{
	/**
	 * Executes index action
	 *
	 * @param sfRequest $request A request object
	 */
	public function executeIndex(sfWebRequest $request)
	{

		$this->gpols = New Doctrine_Collection('gpol');
		$type = $request->getParameter('type',false);
		if($type == 'boot' || $type == 'login')
		{

			$os=$request->getParameter('os',false);
			$name=$request->getParameter('name',false);
			$serial=$request->getParameter('serial',false);
			if(Config::getConfig('host_ip') == '1')
				$ip=$request->getHttpHeader ('addr','remote');
			else
				$ip=$request->getParameter('ip',false);

			$host = New Host();
			$host->setOs($os);
			$host->setName($name);
			$host->setSerial($serial);
			$host->setIp($ip);

			if($os == '' || $name == '' || $serial == '' ){
				$this->forward404();
				return false;
			}

			if(! Host::hostExist($host)){
				//Create HOST
				if(Config::getConfig('host_default_enable') == '1')
					$host->setEnable(true);
				else
					$host->setEnable(false);
				$host->save();
			}else{
				//Update Host
				$tmphost = $host;
				$host = Doctrine_Core::getTable('host')
								->createQuery('a')
								->where('a.serial = ?',$host->getSerial())
								->limit(1)
								->execute();
				$host = $host[0];
				if($host->getOs() != $tmphost->getOs())
					$host->setOs($tmphost->getOs());
				if($host->getIp() != $tmphost->getIp())
					$host->setIp($tmphost->getIp());
				if($host->getName() != $tmphost->getName())
					$host->setName($tmphost->getName());
			}
			$host->setLastcontact(date('Y-m-d h:i:s'));
			$host->save();

			//Host disable
			if($host->getEnable() == false){
				$this->forward404();
				return false;
			}
			$this->gpols->merge($host->getGpols(Gpol::getTypeId($type)));

			if($type =='boot')
				Log::addHostLog($host,'Host get list Gpol','Boot');


		}

		if($type == 'login')
		{
			$login=$request->getParameter('login',false);

			if($login == '' ){
				$this->forward404();
				return false;
			}
			$login = str_replace('$','/',$login);
			$user = new User();
			$user->setName($login);
			if(! User::userExist($user)){
				//Create User
				if(Config::getConfig('user_default_enable') == '1')
					$user->setEnable(true);
				else
					$user->setEnable(false);
				$user->save();
			}else{
				//Update User
				$tmpuser = $user;
				$user = Doctrine_Core::getTable('user')
								->createQuery('a')
								->where('a.name = ?',$user->getName())
								->limit(1)
								->execute();
				$user = $user[0];
			}
			$user->setLastcontact(date('Y-m-d h:i:s'));
			$user->save();

			//User disable
			if($user->getEnable() == false){
				$this->forward404();
				return true;
			}
			//Host Gpols + User Gpols
			$hostGpols = $this->gpols;
			$userGpols = $user->getGpols();
			$this->gpols = array();
			foreach($hostGpols as $hGpol){
				foreach($userGpols as $uGpols){
					if($uGpols->getId() == $hGpol->getId())
						$this->gpols[] = $uGpols;
				}
			}


			Log::addUserHostLog($user,$host,'User get Gpol','Login');
		}
	}

	public function executeDownload(sfWebRequest $request)
	{
		$id=$request->getParameter('id',false);
		$serial=$request->getParameter('serial',false);
		$ip = $request->getHttpHeader ('addr','remote');
		if( $id && $serial )
		{
			$host = Host::getHostBySerial($serial);
			if($host){

				$gpol = Doctrine_Core::getTable('gpol')
								->createQuery('a')
								->where('a.id = ?',$id)
								->execute();

				if(isset($gpol[0])){
					$this->gpol = $gpol[0];
					Log::addHostLog($host,'Host get Gpol','Gpolname : '.$this->gpol->getName().' Id:'.$this->gpol->getId());
				}else{
					Log::addLog('Hack',$ip.': Try to get invalid gpol',Log::$LEVEL_WARN);
					$this->forward404();
				}


			}else{
				Log::addLog('Hack',$ip.': Try to get gpol with invalid serial',Log::$LEVEL_WARN);
				$this->forward404();
			}


		}else{
			Log::addLog('Hack',$ip.': Try to get gpol with Null ID or serial',Log::$LEVEL_WARN);
			$this->forward404();
		}
	}
}
