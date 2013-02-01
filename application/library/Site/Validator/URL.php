<?php

	class Site_Validator_URL extends Zend_Validate_Abstract {

		const URL_INVALID = 'url';
		const URL_NOT_SET = 'You have to specify a valid URL';

		protected $_messageTemplates = array(
			self::URL_INVALID => "'%value%' is not a valid url. No local hostnames allowed btw.",
		);

		public function isValid($value) {

			if (!isset($value)) {
				throw new Zend_Validate_Exception(self::URL_NOT_SET);
				return false;
			}

			$valueString = (string) $value;
			$valueString = trim($valueString);

			if (strpos($valueString,'http://') === false && strpos($valueString, 'https://') === false) $valueString = "http://".$valueString;

			$this->_setValue($valueString);

			// old means of validating, not flawless
			// $test = (bool) preg_match('/^(http:\/\/|https:\/\/|ftp:\/\/|ftps:\/\/|)?[a-z0-9_\-]+[a-z0-9_\-\.]+\.[a-z]{2,4}(\/+[a-z0-9_\.\-\/]*)?$/i',$valueString);

			if (!Zend_Uri::check($valueString)) {
				$this->_error(self::URL_INVALID);
				return false;
			}

			try {
				$uriHttp = Zend_Uri_Http::fromString($valueString);
			} catch (Zend_Uri_Exception $e) {
				$this->_error(self::URL_INVALID);
				return false;
			}

			//do not allow local hostnames
			$hostnameValidator = new Zend_Validate_Hostname(Zend_Validate_Hostname::ALLOW_DNS);
			if (!$hostnameValidator->isValid($uriHttp->getHost())) {
				$this->_error(self::URL_INVALID);
				return false;
			}

			return true;

		}
	}
