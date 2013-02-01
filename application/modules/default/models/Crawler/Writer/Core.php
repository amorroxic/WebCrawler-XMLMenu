<?php

abstract class Crawler_Writer_Core {

	protected $_cacheKey;
	protected $_url;
	protected $_assets;
	protected $_dataReady = false;

	public function setData($inputData) {

		if (!isset($inputData)) {
			throw new Crawler_Writer_Exception(Crawler_Writer_Exception::NO_INPUT_DATA);
		}

		if ( !isset($inputData["url"]) || !isset($inputData["key"]) || !is_array($inputData["assets"]) || ($inputData["url"] == '') || ($inputData["key"] == '')) {
			throw new Crawler_Writer_Exception(Crawler_Writer_Exception::INVALID_INPUT_DATA);
		}

		$this->_cacheKey 	= $inputData["key"];
		$this->_url 		= $inputData["url"];
		$this->_assets 		= $inputData["assets"];

		$this->store();

		$this->_dataReady 	= true;

	}

	protected abstract function store();
	public abstract function output();

}