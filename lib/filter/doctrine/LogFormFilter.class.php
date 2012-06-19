<?php

/**
 * Log filter form.
 *
 * @package    gpol
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class LogFormFilter extends BaseLogFormFilter
{
  public function configure()
  {
	  unset($this['detail'] ) ;
	  //unset($this['date'])  ;
	  unset($this['action'] ) ;
	  unset($this['level'] ) ;
	  $this->widgetSchema['level[text]'] = new sfWidgetFormChoice(array('choices'=>Log::$LEVEL_ARRAY,'label'=>'Level'), array());
	  $this->validatorSchema['level[text]'] = new sfValidatorPass(array('required' => false));
  }
}
