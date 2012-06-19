<?php

/**
 * Config
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @package    gpol
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
class Config extends BaseConfig
{
	static function getConfig($configName){
		$config = Doctrine_Core::getTable('config')
						->createQuery('a')
						->where('name = ?',$configName)
						->limit(1)
						->execute();
		if(isset($config[0]))
			return $config[0]->getValue();
		else
			return false;
	}

}