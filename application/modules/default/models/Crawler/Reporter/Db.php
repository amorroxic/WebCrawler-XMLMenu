<?php

class Crawler_Reporter_Db extends Crawler_Reporter_Core {

	protected function output() {

		$data = null;

		try {
			$dataManager = new Crawler_Data_Manager();
			$data = $dataManager->getRecords($this->_cacheKey);
		} catch (Exception $e) {
			throw new Crawler_Reporter_Exception(Crawler_Reporter_Exception::ERROR_READING);
		}

		return $data;

	}


}