<?php

class IndexController extends Site_Default_Controller
{

	public function indexAction()
	{
		// Set the site title, description, keywords
		$this->view->headTitle("Information");

	}

}