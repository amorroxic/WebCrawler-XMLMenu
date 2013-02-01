<?php

abstract class Crawler_Reporter_Core {

	protected $_cacheKey;

	public function getData($cacheKey) {

		if (!isset($cacheKey)) {
			throw new Crawler_Reporter_Exception(Crawler_Reporter_Exception::CACHE_INVALID);
		}
		$this->_cacheKey = $cacheKey;
		$this->output();

	}

	protected abstract function output();

}