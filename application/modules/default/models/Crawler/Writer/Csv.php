<?php

class Crawler_Writer_Csv extends Crawler_Writer_Core {

	private $fileName;

	protected function store() {

		$this->fileName = ROOTDIR . '/storage/csv/' . $this->_cacheKey . ".csv";

		try {

			// open the file for writing
			$fp = @fopen($this->fileName, 'w');
			if (!$fp) throw new Crawler_Writer_Exception(Crawler_Writer_Exception::ERROR_WRITING);

			// write header
			$result = @fputcsv($fp, array("URL","ASSET","ASSET_COUNT"), ';', '"');
			if (!isset($result)) throw new Crawler_Writer_Exception(Crawler_Writer_Exception::ERROR_WRITING);

			// and data
			foreach ($this->_assets as $asset=>$assetCount) {
				$result = @fputcsv($fp, array($this->_url,$asset,$assetCount), ';', '"');
				if (!isset($result)) throw new Crawler_Writer_Exception(Crawler_Writer_Exception::ERROR_WRITING);
			}

			@fclose($fp);

		} catch (Exception $e) {
			throw new Crawler_Writer_Exception(Crawler_Writer_Exception::ERROR_WRITING);
		}

	}

	public function output() {

	}

}