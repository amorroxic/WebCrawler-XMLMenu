<?php

class Crawler_Exception extends Exception
{

	const COULD_NOT_CONNECT 		= 1010;
	const COULD_NOT_READ_REMOTE 	= 1011;

	const OK 						= 1000;
	const UNKNOWN_ERROR 			= 1050;

	private $messages;

	public function Crawler_Exception($code = 0, Exception $previous = null) {

		$this->messages = array(
			self::COULD_NOT_CONNECT 		=> "Could not connect.",
			self::COULD_NOT_READ_REMOTE 	=> "Could not fetch the assets.",
			self::UNKNOWN_ERROR 			=> "Unknown error occured.",
			self::OK 						=> "Ok."
		);
		if (isset($this->messages[$code])) {
			parent::__construct($this->messages[$code], $code);
		} else {
			parent::__construct($this->messages[Crawler_Exception::UNKNOWN_ERROR], $code);
		}

	}

}
