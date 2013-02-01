<?php

class Crawler_Data_Manager {

	private $urlTable;
	private $urlAssetsTable;

	public function Crawler_Data_Manager() {

		$this->urlTable 		= new Crawler_Data_Table();
		$this->urlAssetsTable 	= new Crawler_Data_Assets_Table();
	}

	public function addRecords($url, $cacheKey, $assets) {

		try {

			$db = Zend_Registry::get('dbAdapter');

			$condition = "cache = ?";
			$value = $cacheKey;
			$statement = $db->quoteInto($condition, $value);

			// clean previous values from the database;
			$select = $this->urlTable->select();
			$select->where($statement);
			$urlList = $this->urlTable->fetchAll($select);

			foreach ($urlList as $urlRow) {
				// clean assets
				$condition = "fetched_url_id = ?";
				$value = $urlRow->id;
				$statement = $db->quoteInto($condition, $value);
				$this->urlAssetsTable->delete($statement);

				// clean url
				$condition = "id = ?";
				$value = $urlRow->id;
				$statement = $db->quoteInto($condition, $value);
				$this->urlTable->delete($statement);
			}

			$statement = array(
				'url'	=>$url,
				'cache'	=>$cacheKey
			);
			$id = $this->urlTable->insert($statement);

			foreach ($assets as $asset=>$assetCount) {
				$statement = array(
					'fetched_url_id'	=>$id,
					'asset'				=>$asset,
					'asset_count'		=>$assetCount
				);
				$this->urlAssetsTable->insert($statement);
			}

		} catch (Exception $e) {
			throw new Crawler_Writer_Exception(Crawler_Writer_Exception::ERROR_WRITING);
		}

	}

	public function getRecords($cacheKey) {

			$db = Zend_Registry::get('dbAdapter');
			$siteFields = array(
				"url" 	=> "u.url",
				"key" 	=> "u.cache"
			);

			$assetFields = array(
				"asset" 	=> "a.asset",
				"count" 	=> "a.asset_count"
			);

			$db = Zend_Registry::get('dbAdapter');
			$select = $db->select()
			             ->from(array('u' => 'fetched_url'), $siteFields)
			             ->joinInner(array('a' => 'fetched_url_assets'),'u.id = a.fetched_url_id',$assetFields);
			$select->where('u.cache = ?', $cacheKey);
			$result = $db->fetchAll($select);
			return $result;

	}

}