<?php

/**
 * Gpol form.
 *
 * @package    gpol
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class GpolForm extends BaseGpolForm
{
  public function configure()
  {
	  $this->widgetSchema['script'] = new sfWidgetFormTextarea(array(), array('cols' => 100, 'rows' => 18,'style'=>'width:100%'));
	  $this->widgetSchema['type'] = new sfWidgetFormSelect(array('choices'=>array(1=>'BOOT',2=>'LOGIN')),array());
  }
}
