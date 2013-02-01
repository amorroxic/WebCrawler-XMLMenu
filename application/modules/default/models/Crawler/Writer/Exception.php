<?php

class Crawler_Writer_Exception extends Exception
{

	const NO_INPUT_DATA 		= 1010;
	const INVALID_INPUT_DATA 	= 1011;
	const ERROR_WRITING 		= 1012;
	const ERROR_READING 		= 1013;

	const OK 					= 1000;
	const UNKNOWN_ERROR 		= 1050;

	private $messages;

	public function Crawler_Writer_Exception($code = 0, Exception $previous = null) {

		$this->messages = array(
			self::NO_INPUT_DATA 		=> "There's no input data.",
			self::INVALID_INPUT_DATA 	=> "Input data is invalid.",
			self::ERROR_WRITING 		=> "Error while saving.",
			self::ERROR_READING 		=> "Error reading assets.",
			self::UNKNOWN_ERROR 		=> "Unknown error occured.",
			self::OK 					=> "Ok."
		);
		if (isset($this->messages[$code])) {
			parent::__construct($this->messages[$code], $code);
		} else {
			parent::__construct($this->messages[Crawler_Writer_Exception::UNKNOWN_ERROR], $code);
		}

	}

}
