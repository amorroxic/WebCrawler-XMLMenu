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
		$assetsForm->setAction($this->view->url(array("controller"=>"crawler"),null,true));

		// Test form validity (it has a custom URL validator built in, strips tags, trims the url field)
		if( $request->isPost() && $assetsForm->isValid($postData) ) {

			// strings like /* even though _extremely dangerous_ pass URI validation
			// therefore we attempt to sanitize a bit more (remove weird characters)
			$urlValue = $this->view->sanitize($postData["siteurl"]);

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

		}
		$this->view->assetsForm = $assetsForm;

	}

	public function resultsAction() {

		$request = $this->getRequest();

		// get the format, check whether we support it, prepare for initialization (capitalize first letter in string)
		$format = $request->getParam("format","db");
		if (!in_array(ucfirst($format), Crawler_Reporter::$frontends)) throw new Crawler_Reporter_Exception(Crawler_Reporter_Exception::FORMAT_UNSUPPORTED);
		$format = ucfirst($format);

		// get the cache key from the request, clean it
		$cacheKey = $request->getParam("key");
		if (!isset($cacheKey))  throw new Crawler_Reporter_Exception(Crawler_Reporter_Exception::CACHE_INVALID);
		$cacheKey = preg_replace("/[^A-Za-z0-9]/", "", $cacheKey);

		$frontend = Crawler_Reporter::factory($format);
		$assets = $frontend->getData($cacheKey);
		$this->view->assets = $assets;

	}

}