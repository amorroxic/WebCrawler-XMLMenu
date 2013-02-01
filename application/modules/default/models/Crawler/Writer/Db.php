<?php

class Crawler_Writer_Db extends Crawler_Writer_Core {

	private $dataManager;

	protected function store() {

		try {

			$this->dataManager = new Crawler_Data_Manager();
			$this->dataManager->addRecords($this->_url, $this->_cacheKey, $this->_assets);

		} catch (Exception $e) {
			throw new Crawler_Writer_Exception(Crawler_Writer_Exception::ERROR_WRITING);
		}

	}

	public function output() {

	}

}