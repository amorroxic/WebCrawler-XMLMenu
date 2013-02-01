<?php

class Zend_View_Helper_Slug extends Zend_View_Helper_Abstract
{

	public function slug($content="") {

		// Swap out Non "Letters" with a -
		$text = preg_replace('/[^\\pL\d]+/u', '-', $content);
		// Trim out extra -'s
		$text = trim($text, '-');
		// Convert letters that we have left to the closest ASCII representation
		$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
		// Make text lowercase
		$text = strtolower($text);
		// Strip out anything we haven't been able to convert
		$text = preg_replace('/[^-\w]+/', '', $text);
		return $text;

	}

}


