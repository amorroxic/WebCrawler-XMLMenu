<?php

class Zend_View_Helper_TextTrim
{
	function textTrim($text="",$length=100,$amountLastCharacters=28) {

		$delimitator = " ... ";
		$delimitatorLength = strlen($delimitator);
		if (strlen($text) > $length) $text = substr($text,0,$length-$delimitatorLength-$amountLastCharacters) . $delimitator . substr($text, -$amountLastCharacters);
		return $text;

	}
}

