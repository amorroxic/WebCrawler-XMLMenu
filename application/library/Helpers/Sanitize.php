<?php

class Zend_View_Helper_Sanitize extends Zend_View_Helper_Abstract
{

	public function sanitize($content="") {

		$content = trim($content);
		$content = preg_replace("/[^A-Za-z0-9\/?#=:\.!&%~]/", "-", $content);
		$content = preg_replace('{\-+}', '-', $content);
		$content = strtolower($content);
		return $content;

	}

}
