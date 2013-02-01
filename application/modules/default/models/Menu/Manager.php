<?php

class Menu_Manager
{

	private $_xmlSource;

	public function Menu_Manager($xmlSource = null) {

		if (!is_string($xmlSource)) throw new Menu_Exception(Menu_Exception::IMPORTER_DATASET_ABSENT);
		$this->_xmlSource = $xmlSource;

	}

	public function getData() {

		// try to load from cache
		$cacheKey = md5($this->_xmlSource);
		$data = Plugins_Cache::$cacheInstance->load($cacheKey);
		if ( !isset($data) || ($data === false) ) {
			// not found. import xml
			$data = $this->importFromXML();

			//store in cache
			Plugins_Cache::$cacheInstance->save($data, $cacheKey);
		}
		return $data;
	}

	private function importFromXML() {

		$filepath = ROOTDIR . '/configuration/' . $this->_xmlSource;
		if (!file_exists($filepath)) throw new Menu_Exception(Menu_Exception::IMPORTER_DATASET_ABSENT);

		$xmlString = @file_get_contents($filepath);
		if ($xmlString === false) throw new Menu_Exception(Menu_Exception::IMPORTER_CANNOT_READ_DATASET);

		try {
			// Turn off warnings
			libxml_use_internal_errors(true);

			// load xml
			$xml = simplexml_load_string($xmlString);

			// xml to array
			$menu = json_decode(json_encode((array)$xml),1);

			// too much information inside the data structure, dump it
			$result = $this->parseData($menu);
		} catch (Exception $e) {
			throw new Menu_Exception(Menu_Exception::IMPORTER_CANNOT_READ_DATASET);
		}

		libxml_clear_errors();

		return $result;

	}

	private function parseData($node) {
		$result = array();
		if (isset($node["menuitem"]['@attributes'])) {
			$attributes = $node["menuitem"]["@attributes"];
			$element = array('title'=>$attributes['title'],'type'=>$attributes['type'],'id'=>$attributes['uid'],'children'=>array());
		}
		else {
			foreach ($node["menuitem"] as $child) {
				$attributes = $child["@attributes"];
				$element = array('title'=>$attributes['title'],'type'=>$attributes['type'],'id'=>$attributes['uid'],'children'=>array());
				if (is_array($child['menuitem'])) $element['children'] = $this->parseData($child);
				$result[] = $element;
			}
		}
		return $result;
	}

}
