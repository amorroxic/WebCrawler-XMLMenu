<?php

class CrawlerController extends Site_Default_Controller
{

	private $importManager;

	public function indexAction()
	{
		// Set the site title, description, keywords
		$this->view->headTitle("Crawler demo");

		// Get the post data
		$request = $this->getRequest();
		$postData = $request->getPost();

		// Instantiate the form
		$assetsForm = new Site_Form_Assets();

		// Post to self
		$assetsForm->setAction($request->getControllerName());

		// Test form validity (it has a custom URL validator built in, strips tags, trims the url field)
		if( $request->isPost() && $assetsForm->isValid($postData) ) {

			// strings like /* even though _extremely dangerous_ pass URI validation
			// therefore we attempt to sanitize a bit more (remove weird characters)
			$urlValue = $this->view->sanitize($postData["siteurl"]);

			try {
				$importManager = new Crawler_Import_Manager();
				$assets = $importManager->getAssets($urlValue);

				$dbBackend = Crawler_Writer::factory('Db');
				$dbBackend->setData($assets);
				$csvBackend = Crawler_Writer::factory('Csv');
				$csvBackend->setData($assets);
				$pdfBackend = Crawler_Writer::factory('Pdf');
				$pdfBackend->setData($assets);

				$this->view->assets = $assets;
				$this->_helper->viewRenderer->setRender("crawl-result");


			} catch (Crawler_Exception $e) {
				die($e->getMessage().' ['.$e->getCode().']');
			}

		}
		$this->view->assetsForm = $assetsForm;

	}

}