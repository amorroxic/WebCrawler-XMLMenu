<?php

class Site_Default_Controller extends Site_Controller
{

	public function init()
	{
		parent::init();

		// Set the layout
		$this->_helper->layout->setLayout('layout');

		// Set the site description, keywords
		$this->view->headMeta()->appendName('description', 'This is a demo for Rational FT. Oh hai.');
		$this->view->headMeta()->appendName('keywords', 'keywords, are, evil');

	}

}