<?php

class Crawler_Reporter_Db extends Crawler_Reporter_Core {

	protected function output() {

		try {


		} catch (Exception $e) {
			throw new Crawler_Reporter_Exception(Crawler_Reporter_Exception::ERROR_READING);
		}

	}

}