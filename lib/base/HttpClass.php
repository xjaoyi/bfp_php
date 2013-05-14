<?php
class HttpClass {
	public static function curlPost($url, $post) {
		$ch = curl_init ();
		curl_setopt ( $ch, CURLOPT_URL, $url );
		curl_setopt ( $ch, CURLOPT_POST, 1 );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, $post );
		$result = curl_exec ( $ch );
		$resinfo = curl_getinfo ( $ch );
		curl_close ( $ch );
		unset ( $ch );
		return array (
				'data' => $result,
				'info' => $resinfo 
		);
	}
}