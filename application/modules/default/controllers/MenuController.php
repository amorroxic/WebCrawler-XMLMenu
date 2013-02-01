<?php

class MenuController extends Site_Default_Controller
{

	private $menuManager;

	public function indexAction()
	{
		// Set the site title
		$this->view->headTitle("Menu demo");

		try {
			$this->menuManager = new Menu_Manager('s-menu.xml');
			$this->view->menuData = $this->menuManager->getData();
		} catch (Menu_Exception $e) {
			die($e->getMessage().' ['.$e->getCode().']');
		}

	}

}