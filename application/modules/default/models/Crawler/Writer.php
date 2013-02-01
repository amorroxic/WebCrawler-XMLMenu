<?php

abstract class Crawler_Writer {

	public static $backends = array('Pdf','Csv','Db');

	public static function factory($backend) {
		$backendClass = 'Crawler_Writer_' . $backend;
		$backendInstance = new $backendClass;
		return $backendInstance;
	}

}