<?php

class Crawler_Reporter_Csv extends Crawler_Reporter_Core {

	protected function output() {

		try {

			ini_set('memory_limit','150M');
			// required for IE, otherwise Content-disposition is ignored
			if(ini_get('zlib.output_compression'))
			  ini_set('zlib.output_compression', 'Off');

			$baseDownloadPath = $_SERVER["DOCUMENT_ROOT"];
			$downloadPathArray = explode("/",$baseDownloadPath);
			array_pop($downloadPathArray);
			$baseDownloadPath = implode("/",$downloadPathArray);
			$filename = $baseDownloadPath . "/storage/csv/" . $this->_cacheKey . ".csv";

			$contentType = "application/csv";

			header("Pragma: public"); // required
			header("Expires: 0");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
			header("Cache-Control: private",false); // required for certain browsers
			header("Content-Type: $contentType");
			// change, added quotes to allow spaces in filenames, by Rajkumar Singh
			header("Content-Disposition: attachment; filename=\"".basename($filename)."\";" );
			header("Content-Transfer-Encoding: binary");
			header("Content-Length: ".filesize($filename));
			readfile($filename);
			exit();

		} catch (Exception $e) {
			throw new Crawler_Reporter_Exception(Crawler_Reporter_Exception::ERROR_READING);
		}

	}

}