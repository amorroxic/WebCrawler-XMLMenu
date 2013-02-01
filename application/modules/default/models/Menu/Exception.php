<?php

class Menu_Exception extends Exception
{

	const IMPORTER_DATASET_ABSENT 		= 1010;
	const IMPORTER_CANNOT_READ_DATASET 	= 1011;

	const OK 							= 1000;
	const UNKNOWN_ERROR 				= 1050;

	private $messages;

	public function Menu_Exception($code = 0, Exception $previous = null) {

		$this->messages = array(
			self::IMPORTER_DATASET_ABSENT 		=> "You have to provide an xml source file for the menu.",
			self::IMPORTER_CANNOT_READ_DATASET 	=> "Cannot read menu source file.",
			self::UNKNOWN_ERROR 				=> "Unknown error occured.",
			self::OK 							=> "Ok."
		);
		if (isset($this->messages[$code])) {
			parent::__construct($this->messages[$code], $code);
		} else {
			parent::__construct($this->messages[Menu_Exception::UNKNOWN_ERROR], $code);
		}

	}

}
