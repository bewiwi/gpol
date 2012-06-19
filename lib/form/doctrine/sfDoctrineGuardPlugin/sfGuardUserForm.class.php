<?php

/**
 * sfGuardUser form.
 *
 * @package    gpol
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrinePluginFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class sfGuardUserForm extends PluginsfGuardUserForm
{
  public function configure()
  {
	  unset($this['is_super_admin']);
	  unset($this['last_login']);
	  unset($this['created_at']);
	  unset($this['updated_at']);
	  unset($this['groups_list']);
	  unset($this['permissions_list']);
	  unset($this['salt']);
	  unset($this['algorithm']);

	  $this->widgetSchema['password'] = new sfWidgetFormInputPassword();
  }
}
