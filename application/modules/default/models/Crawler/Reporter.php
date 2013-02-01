<?php

abstract class Crawler_Reporter {

	public static $frontends = array('Pdf','Csv','Db');

	public static function factory($frontend) {
		$frontendClass = 'Crawler_Reporter_' . $frontend;
		$frontendInstance = new $frontendClass;
		return $frontendInstance;
	}

}