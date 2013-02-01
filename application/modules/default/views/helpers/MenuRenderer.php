<?php

class Zend_View_Helper_MenuRenderer extends Zend_View_Helper_Abstract
{
	public $view;
	private $_template;
	private $_tabCount;

	public function menuRenderer($data) {

		$this->_template = $template;
		$this->_tabCount = 0;

		$cacheKey = md5(serialize($data));
		$cachedPage = Plugins_Cache::$cacheInstance->load($cacheKey);
		if ($cachedPage) return $cachedPage;
		$content = $this->view->render($this->template);
		$content = $this->renderData($data,1);
		Plugins_Cache::$cacheInstance->save($content, $cacheKey);
		return $content;

	}

	private function renderData($data,$depth=1) {

		$this->_tabCount++;
		$content .= $this->tab();
		$content .= "<ul class='depth-".$depth."'>".PHP_EOL;

		$this->_tabCount++;
		foreach ($data as $child) {

			$cssClass = "no-options";
			if (count($child['children'])>0) {
				$cssClass = "has-options";
			}

			$content .= $this->tab();
			$content .= "<li class='" . $child['type'] . " " . $cssClass . "'>".PHP_EOL;

			$this->_tabCount++;
			$content .= $this->tab();
			$content .= "<a href='#'>" . $child['title'] . "</a>".PHP_EOL;

			if (count($child['children'])>0) {
				$content .= $this->renderData($child['children'],++$depth);
			}
			$this->_tabCount--;

			$content .= $this->tab();
			$content .= "</li>".PHP_EOL;
		}
		$this->_tabCount--;

		$content .= $this->tab();
		$content .= "</ul>".PHP_EOL;
		$content .= $this->tab();
		$content .= "<div class='clear'></div>".PHP_EOL;;

		$this->_tabCount--;

		return $content;
	}

	private function tab() {
		return str_repeat("\t", $this->_tabCount);
	}

}
