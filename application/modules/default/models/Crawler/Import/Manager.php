<?php

class Crawler_Import_Manager
{

	private $allowedExtensions;

	public function Crawler_Import_Manager() {
		// some extensions we want to crawl for
		$this->allowedExtensions = array('jpg','jpeg','png','gif','xml','txt','doc','pdf','mov','mp3','mp4','svg');
	}

	public function getAssets($url) {

		// try to load from cache
		$cacheKey = md5($url);
		$assets = Plugins_Cache::$cacheInstance->load($cacheKey);

		$cached = true;
		if ($assets === false) {
			// not found. panic, scan the internets.
			$assets = $this->scanRemoteAssets($url);
			Plugins_Cache::$cacheInstance->save($assets, $cacheKey);
			$cached = false;
		}

		return array('url'=>$url,'cached'=>$cached,'key'=>$cacheKey,'assets'=>$assets);
	}

	private function scanRemoteAssets($url) {

		$remoteContentText = $this->scanLocation($url);
		if (!$remoteContentText) {
			throw new Crawler_Exception(Crawler_Exception::COULD_NOT_READ_REMOTE);
		} else {
			$validAssets = array();
			$matches = array();

			//match for image tags
			preg_match_all('/<\s*img.*?src="(?:)?(.*?)(?<!\/|\")".*?>/i', $remoteContentText, $matches);
			$resources = $matches[1];

			// match for anchor tags
			preg_match_all('/<\s*a.*?href="(?:)?(.*?)(?<!\")".*?>/i', $remoteContentText, $matches);
			$resources = array_merge($resources,$matches[1]);

			foreach ($resources as $resource)
				if ($this->assetIsValid($resource)) array_key_exists($resource, $validAssets) ? $validAssets[$resource]++ : $validAssets[$resource]=1;

		}

		return $validAssets;
	}

	private function scanLocation($url) {
		try {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$remoteContent = curl_exec($ch);
			curl_close($ch);
		} catch (Exception $e) {
			throw new Crawler_Exception(Crawler_Exception::COULD_NOT_CONNECT);
		}
		return $remoteContent;
	}

	private function assetIsValid($asset) {
		// fastest determination of a file's extension that I could think of right now
		$ext = pathinfo($asset, PATHINFO_EXTENSION);
		// extension still not okay. it may be file.jpg?param=value. Fix that.
		$qpos = strpos($ext, "?");
		if ($qpos!==false) $ext = substr($ext, 0, $qpos);
		return in_array($ext, $this->allowedExtensions);
	}

}

// old regexp attempts
//preg_match_all("/(a href\=\")([^\?\"]*)(?<!\/)(\")/i", $remoteContentText, $matches);
//preg_match_all("#(\s(?:href|src)=[\"'])(?!http://)\.?/?([^\"'\r\n]+)(?<!\/)(?:\"|\'')#i", $remoteContentText, $matches);

