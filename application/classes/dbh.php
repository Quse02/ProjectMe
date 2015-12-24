<?php
class DBH extends PDO {
	public function __construct($db = null) {
		global $_DBH_DEFAULT;
		global $_CONF_DIR;
		
		if (!$db) {
			$db = $_DBH_DEFAULT;
		}

		// Must set variable $db_conf in config file
		include "{$_CONF_DIR}/db/{$db}.php";
	
		$db_conf['dsn'] = (!empty($db_conf['dsn']))? $db_conf['dsn'] : null;
		$db_conf['user'] = (!empty($db_conf['user']))? $db_conf['user'] : null;
		$db_conf['passwd'] = (!empty($db_conf['passwd']))? $db_conf['passwd'] : null;
		$db_conf['extra'] = (!empty($db_conf['extra']))? $db_conf['extra'] : null;
		
		try {
			parent::__construct($db_conf['dsn'], $db_conf['user'], $db_conf['passwd'], $db_conf['extra']);
		} catch (Exception $ex) {
			throw new Safe_Exception("Could not connect to database.");
		}
	}
}