<?php

/**
 * log actions.
 *
 * @package    gpol
 * @subpackage log
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class logActions extends sfActions
{
	public function executeIndex(sfWebRequest $request)
	{
		$this->formFilter = new LogFormFilter();

		$val_form = array();
		if($request->isMethod('post')) {
			$tmp_form = $request->getParameter($this->formFilter->getName());
			$tmp_form['level[text]']=$tmp_form['level'];
			$val_form = $tmp_form;
			unset($tmp_form['level'] ) ;
			$this->formFilter->bind($tmp_form);
			$query = $this->formFilter->buildQuery($val_form);
			$this->logs = $query->execute();

		}else{

			$query = Doctrine_Core::getTable('log')->createQuery('a');

			$this->pager = new sfDoctrinePager('Log',	30);
			$this->pager->setQuery($query->orderBy('id DESC'));
			$this->pager->setPage($request->getParameter('page', 1));
			$this->pager->init();

			$this->logs = $this->pager->getResults();
		}
	}

}
