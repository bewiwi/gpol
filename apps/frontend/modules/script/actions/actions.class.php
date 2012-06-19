<?php

/**
 * script actions.
 *
 * @package    gpol
 * @subpackage script
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class scriptActions extends sfActions
{
	/**
	 * Executes index action
	 *
	 * @param sfRequest $request A request object
	 */
	public function executeIndex(sfWebRequest $request)
	{
		// being sure no other content wil be output
		$this->setLayout(false);
		//sfConfig::set('sf_web_debug', false);

		$pdfpath = sfConfig::get('sf_root_dir').DIRECTORY_SEPARATOR.'script'
						.DIRECTORY_SEPARATOR
						.$request->getParameter('filename');

		// check if the file exists
		$this->forward404Unless(file_exists($pdfpath));

		// Adding the file to the Response object
		$this->getResponse()->clearHttpHeaders();
		$this->getResponse()->setHttpHeader('Pragma: public', true);
		$this->getResponse()->setContentType('text/plain');
		$this->getResponse()->sendHttpHeaders();
		$this->getResponse()->setContent(readfile($pdfpath));
		//return sfView::NONE;
	}
}
