<?php
// 参数效验
class CheckPostClass {
	// pay
	static public function pay($data = array()) {
		echo 'pay';
	}
	
	// pay
	static public function channel($data = array()) {
		if (isset ( $data ['server_id'] ) && isset ( $data ['qd'] ) && isset ( $data ['server_id'] )) {
			return array (
					'msgType' => $data ['msgType'],
					'server_id' => intval ( $data ['server_id'] ),
					'qd' => intval ( $data ['qd'] ) 
			);
		} else {
			return false;
		}
	}
	
	// register
	static public function register($data = array()) {
		if (! empty ( $data ['username'] ) && ! empty ( $data ['password'] ) && isset ( $data ['type'] ) && isset ( $data ['qd'] ) && isset ( $data ['imei'] )) {
			$data ['username'] = addslashes ( $data ['username'] );
			$data ['password'] = addslashes ( $data ['password'] );
			$data ['type'] = addslashes ( $data ['type'] );
			$data ['qd'] = intval ( $data ['qd'] );
			$data ['imei'] = addslashes ( $data ['imei'] );
			return $data;
		} else {
			return false;
		}
	}
}