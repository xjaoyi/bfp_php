<?php
class DbClass {
	const TESTMODEL = 0;
	public static $dh;
	public function __construct() {
		include_once (CONFIG_PATH.'db.php');
		$dsn = "{$config['datebaseType']}:host={$config['host']};dbname={$config['dbname']};charset={$config['charset']}";
		try {
			self::$dh = new PDO ( $dsn, $config ['username'], $config ['password'] );
		} catch ( Exception $e ) {
			die ( 'Datebase not connection!' );
		}
	}
	
	/**
	 * Format a local time/date
	 * $data count() array('filed','table','where')
	 */
	public function count($data) {
		$filed = ! empty ( $data ['filed'] ) ? $data ['filed'] : '*';
		$sql = 'SELECT count(' . $filed . ') FROM ' . $data ['table'];
		$sql .= ! empty ( $data ['where'] ) ? " WHERE " . $data ['where'] : "";
		echo (self::TESTMODEL == 1) ? $sql . '<br>' : '';
		$db = $this->getAdapter ();
		$res = $db->fetchone ( $sql );
		return $res;
	}
	
	// 去重信息
	public function distinct($data) {
		$filed = ! empty ( $data ['filed'] ) ? $data ['filed'] : '*';
		$sql = 'SELECT distinct(' . $filed . ') FROM ' . $data ['table'];
		$sql .= ! empty ( $data ['where'] ) ? " WHERE " . $data ['where'] : "";
		echo (self::TESTMODEL == 1) ? $sql . '<br>' : '';
		$db = $this->getAdapter ();
		$res = $db->fetchone ( $sql );
		return $res;
	}
	
	//
	/**
	 * 汇总信息
	 * @data 'filed','table','where'
	 */
	public function sum($data) {
		$filed = ! empty ( $data ['filed'] ) ? $data ['filed'] : '*';
		$sql = 'SELECT sum(' . $filed . ') FROM ' . $data ['table'];
		$sql .= ! empty ( $data ['where'] ) ? " WHERE " . $data ['where'] : "";
		echo (self::TESTMODEL == 1) ? $sql . '<br>' : '';
		$db = $this->getAdapter ();
		$res = $db->fetchone ( $sql );
		return $res;
	}
	
	/**
	 * 求最大值
	 * $data max() array('filed','table','where')
	 */
	public function max($data) {
		$filed = ! empty ( $data ['filed'] ) ? $data ['filed'] : '*';
		$sql = 'SELECT max(' . $filed . ') FROM ' . $data ['table'];
		$sql .= ! empty ( $data ['where'] ) ? " WHERE " . $data ['where'] : "";
		echo (self::TESTMODEL == 1) ? $sql . '<br>' : '';
		$db = $this->getAdapter ();
		$res = $db->fetchone ( $sql );
		return $res;
	}
	
	/**
	 * 求最小值
	 * $data min() array('filed','table','where')
	 */
	public function min($data) {
		$filed = isset ( $data ['filed'] ) ? $data ['filed'] : '*';
		$sql = 'SELECT MIN(' . $filed . ') FROM ' . $data ['table'];
		$sql .= isset ( $data ['where'] ) ? " WHERE " . $data ['where'] : "";
		echo (self::TESTMODEL == 1) ? $sql . '<br>' : '';
		$db = $this->getAdapter ();
		$res = $db->fetchone ( $sql );
		return $res;
	}
	
	/**
	 * 求最小值
	 * $data avg() array('filed','table','where')
	 */
	public function avg($data) {
		$filed = isset ( $data ['filed'] ) ? $data ['filed'] : '*';
		$sql = 'SELECT AVG(' . $filed . ') FROM ' . $data ['table'];
		$sql .= isset ( $data ['where'] ) ? " WHERE " . $data ['where'] : "";
		echo (self::TESTMODEL == 1) ? $sql . '<br>' : '';
		$db = $this->getAdapter ();
		$res = $db->fetchone ( $sql );
		return $res;
	}
	
	/**
	 * 搜索
	 * @data 'filed','table','where' ['group']|['order']|['limit']
	 */
	public function sel_query($data) {
		$filed = ! empty ( $data ['filed'] ) ? $data ['filed'] : '*';
		$sql = 'SELECT ' . $filed . ' FROM ' . $data ['table'];
		$sql .= ! empty ( $data ['where'] ) ? ' WHERE ' . $data ['where'] : "";
		$sql .= ! empty ( $data ['group'] ) ? ' GROUP BY ' . $data ['group'] : "";
		$sql .= ! empty ( $data ['order'] ) ? ' ORDER BY ' . $data ['order'] : "";
		$sql .= ! empty ( $data ['limit'] ) ? ' LIMIT  0,' . $data ['limit'] : "";
		
		echo (self::TESTMODEL == 1) ? $sql . '<br>' : '';
		return self::$dh->query ( $sql )->fetchAll ( PDO::FETCH_ASSOC );
		;
	}
	
	/**
	 * prepare 执行
	 * @data 'filed','table','where' ['group']|['order']|['limit']
	 */
	public function sql_exec($_sql, $data, $type = 'select', $action = 'fetchAll', $parms = 'PDO::FETCH_ASSOC') {
		// var_dump($_sql);
		if (is_array ( $_sql )) {
			$filed = ! empty ( $_sql ['filed'] ) ? $_sql ['filed'] : '*';
			$sql = 'SELECT ' . $filed . ' FROM ' . $_sql ['table'];
			echo $sql;
			echo "<br>";
			$sql .= ! empty ( $_sql ['where'] ) ? " WHERE {$_sql['where']}" : "";
			echo $sql;
			echo "<br>";
			$sql .= ! empty ( $_sql ['group'] ) ? ' GROUP BY ' . $_sql ['group'] : "";
			$sql .= ! empty ( $_sql ['order'] ) ? ' ORDER BY ' . $_sql ['order'] : "";
			$sql .= ! empty ( $_sql ['limit'] ) ? ' LIMIT  0,' . $_sql ['limit'] : "";
		} else {
			$sql = $_sql;
		}
		$stmt = self::$dh->prepare ( $sql );
		foreach ( $data as $key => $val ) {
			try {
				self::$dh->beginTransaction ();
				$result = $stmt->execute ( $val );
				
				// 结果集处理
				switch (strtolower ( $type )) {
					case 'select' :
						if (! empty ( $result )) {
							switch ($action) {
								case 'fetchAll' :
									$res [] = $stmt->fetchAll ( PDO::FETCH_ASSOC );
									break;
							}
						}
						break;
				}
				
				$result = self::$dh->commit ();
			} catch ( Exception $e ) {
				self::$dh->rollBack ();
				echo "Failed: " . $e->getMessage ();
			}
		}
		
		echo (self::TESTMODEL == 1) ? $sql . '<br>' : '';
		return ! empty ( $result ) ? (! empty ( $res )) ? $res : $result : false;
	}
	
	/**
	 * PDO query .
	 * ..
	 */
	public function dbquery($sql) {
		self::$dh->beginTransaction ();
		try {
			echo (self::TESTMODEL == 1) ? $sql . '<br>' : '';
			$rows = self::$dh->query ( $sql )->fetchAll ( PDO::FETCH_ASSOC );
			$last_insert_id = self::$dh->lastInsertId ();
			self::$dh->commit ();
			return $rows;
		} catch ( Exception $e ) {
			self::$dh->rollBack ();
			return false;
			// echo '捕获导常'.$e->getMessage(); //打印出异常信息
		}
	}
	
	/**
	 * 搜索一条
	 * @data 'filed','table','where' ['group']|['order']
	 */
	public function sel_one($data) {
		$filed = ! empty ( $data ['filed'] ) ? $data ['filed'] : '*';
		$sql = 'SELECT ' . $filed . ' FROM ' . $data ['table'];
		$sql .= ! empty ( $data ['where'] ) ? ' WHERE ' . $data ['where'] : "";
		$sql .= ! empty ( $data ['group'] ) ? ' GROUP BY ' . $data ['group'] : "";
		$sql .= ! empty ( $data ['order'] ) ? ' ORDER BY ' . $data ['order'] : "";
		$sql .= ' LIMIT 1';
		echo (self::TESTMODEL == 1) ? $sql . '<br>' : '';
		$db = $this->getAdapter ();
		return $db->fetchRow ( $sql );
	}
	
	/**
	 * 添加信息 <br>
	 * @table <br>
	 * @rows : array pram values
	 */
	public function inserts($table, $rows) {
		$db = $this->getAdapter ();
		$db->beginTransaction ();
		try {
			// 插入信息
			$rows_affected = $db->insert ( $table, $rows );
			$last_insert_id = $db->lastInsertId ();
			$db->commit ();
		} catch ( Exception $e ) {
			$db->rollBack ();
			return false;
			// echo '捕获导常'.$e->getMessage(); //打印出异常信息
		}
		return $last_insert_id;
	}
	
	/**
	 * 插入多行记录
	 * @table<br>
	 * @rowsArray : array prams values
	 */
	public function insertRows($table, $rows) {
		if (count ( $rows ) < 1) {
			return false;
		}
		$value = null;
		foreach ( $rows as $v ) {
			$col_value = null;
			foreach ( $v as $kk => $vv ) {
				if (is_string ( $vv )) {
					$col_value .= ("'" . $vv . "',");
				} else {
					$col_value .= ($vv . ',');
				}
			}
			$col_value = (substr ( $col_value, - 1 ) == ',') ? substr ( $col_value, 0, - 1 ) : $col_value;
			$value .= ! empty ( $col_value ) ? '(' . $col_value . '),' : null;
		}
		$value = (substr ( $value, - 1 ) == ',') ? substr ( $value, 0, - 1 ) : $value;
		
		$rowsKeys = array_keys ( $rows ['0'] );
		$keysWhere = '(' . implode ( ',', $rowsKeys ) . ') ';
		
		$sql = 'INSERT INTO ' . $table . $keysWhere . ' VALUES ' . $value;
		echo (self::TESTMODEL == 1) ? $sql . '<br>' : '';
		$db = $this->getAdapter ();
		$db->beginTransaction ();
		try {
			$rows_affected = $db->query ( $sql );
			$last_insert_id = $db->lastInsertId ();
			$db->commit ();
		} catch ( Exception $e ) {
			$db->rollBack ();
			echo '捕获导常' . $e->getMessage (); // 打印出异常信息
		}
		return $last_insert_id;
	}
	
	/**
	 * 更新信息 <br>
	 * @table <br>
	 * @setArray : Column-Value vlues<br>
	 * @where ''
	 */
	public function updates($table, $setArray, $where = '') {
		$where = ! empty ( $where ) ? $where : '';
		$db = $this->getAdapter ();
		$resNums = $db->update ( $table, $setArray, $where );
		return $resNums;
	}
	
	/**
	 * 删除信息 <br>
	 * @table <br>
	 * @where '必须指定范围，否则失效'
	 */
	public function deletes($table, $where) {
		$where = ! empty ( $where ) ? $where : 'FALSE';
		$db = $this->getAdapter ();
		$resNums = $db->delete ( $table, $where );
		return $resNums;
	}
}