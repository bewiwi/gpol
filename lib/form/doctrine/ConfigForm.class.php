<?php

/**
 * Config form.
 *
 * @package    gpol
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class ConfigForm extends BaseConfigForm
{
  public function configure()
  {
	  unset($this['name']);
	  unset($this['description']);

  }
}
