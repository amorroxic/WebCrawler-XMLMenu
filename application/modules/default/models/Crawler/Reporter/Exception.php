<?php

class Crawler_Reporter_Exception extends Exception
{

	const CACHE_INVALID 		= 1010;
	const FORMAT_UNSUPPORTED 	= 1011;
	const ERROR_READING 		= 1013;

	const OK 					= 1000;
	const UNKNOWN_ERROR 		= 1050;

	private $messages;

	public function Crawler_Reporter_Exception($code = 0, Exception $previous = null) {

		$this->messages = array(
			self::CACHE_INVALID 		=> "The link has expired. Please query again.",
			self::ERROR_READING 		=> "Error reading asset data.",
			self::FORMAT_UNSUPPORTED 	=> "Requested data format is not supported.",
			self::UNKNOWN_ERROR 		=> "Unknown error occured.",
			self::OK 					=> "Ok."
		);
		if (isset($this->messages[$code])) {
			parent::__construct($this->messages[$code], $code);
		} else {
			parent::__construct($this->messages[Crawler_Reporter_Exception::UNKNOWN_ERROR], $code);
		}

	}

}
