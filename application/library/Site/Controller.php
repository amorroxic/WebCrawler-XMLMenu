<?php

class Site_Controller extends Zend_Controller_Action
{

	public function init()
	{
		$this->view->addHelperPath(ROOTDIR.'/application/library/Helpers/','Zend_View_Helper');
	}

}