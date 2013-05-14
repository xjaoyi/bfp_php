<?php
class SortClass {
	public static $sortArr;
	/**
	 * 请求目录列表
	 * @param unknown $data
	 * @return Ambigous <boolean, multitype:unknown >
	 */
	static public function sort($data) {
		foreach ( $data as $key => $val ) {
			if ($isArr = self::ssort ( $data, $val ['id'] )) {
				self::$sortArr [$val ['id']] = $isArr;
			}
		}
		return self::$sortArr;
	}
	/**
	 * 请求当前下级目录
	 * @param unknown $data
	 * @param unknown $id
	 * @return Ambigous <boolean, multitype:unknown >
	 */
	static protected function ssort($data, $id) {
		$arr = array ();
		foreach ( $data as $val ) {
			if ($val ['pid'] == $id) {
				$key = $val ['sort'];
				if (! empty ( $arr [$key] )) {
					$key ++;
				}
				$arr [$key] = $val;
			}
		}
		if (! empty ( $arr ))
			ksort ( $arr );
		return ! empty ( $arr ) ? $arr : false;
	}
	
	/**
	 * 请求当前目录
	 * @param unknown $data
	 * @return string
	 */
	static public function sortList($data='') {
		$Data = CacheClass::load ( 'menuData' );
		if (empty ( $Data )) {
			$Data = self::sort ( $data );
			CacheClass::save ( $Data, 'menuData' );
		}
		// //////////////////////////////////////////////////
		$html = "<ul>";
		$k = 1;
		foreach ( current ( $Data ) as $val ) {
			$html .= '<li>' . $val ['name'] . '</li>';
			if ($k == 1) {
				$html .= "<ul>";
				foreach ( $Data [$val ['id']] as $v ) {
					$html .= '<li>' . $v ['name'] . '</li>';
				}
				$html .= "</ul>";
				$k = 0;
			}
		}
		$html .= "</ul>";
		// ////////////////////////////////////////////////
		return $html;
	}
}