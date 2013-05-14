<?php
// 页面头部
class CacheClass {
	public static $CachePath;
	static function init() {
		self::$CachePath = CACHE_PATH;
	}
	static function load($cacheName) {
		self::init ();
		$fileName = self::$CachePath . $cacheName . 'Cache.php';
		if (file_exists ( $fileName )) {
			return include ($fileName);
		} else {
			return false;
		}
	}
	static function save($cacheData, $cacheName) {
		self::init ();
		$fileName = self::$CachePath . $cacheName . 'Cache.php';
		if (is_writable ( self::$CachePath )) {
			$cacheData = '<?php return ' . var_export ( $cacheData, TRUE ) . ';?>';
			self::fileWrite ( $fileName, $cacheData );
			return true;
		} else {
			return false;
		}
	}
	
	/**
	 *
	 * @param unknown $fileName        	
	 * @param string $fileContent        	
	 * @param string $type        	
	 * @return boolean
	 */
	static function fileWrite($fileName, $fileContent, $type = "w+") {
		if ($fp = fopen ( $fileName, $type )) {
			if (flock ( $fp, LOCK_EX )) {
				fwrite ( $fp, $fileContent );
				flock ( $fp, LOCK_UN );
			}
			fclose ( $fp );
			return true;
		} else {
			return false;
		}
	}
}
