<?php
/**
* 数据库操作类
*/
error_reporting(E_ALL & ~(E_STRICT | E_NOTICE));
error_reporting(0);
 
$main = include dirname(__FILE__).'/../protected/config/main.php';
 
$mysql = $main['components']['db']; 
$db = new db;
$db->connect($mysql);
ini_set('date.timezone',$main['timeZone']?$main['timeZone']:'Asia/Shanghai');
function dump($str){
	print_r('<pre>');
	print_r($str);
	print_r('</pre>');
}
class db{
	protected $_conn;
	protected $_query;
	function connect($mysql){
		$this->_conn = new PDO($mysql['dsn'],$mysql['username'],$mysql['password'],array(
			PDO::ATTR_PERSISTENT=>true
		));
	}
	function query($sql){
		$this->_query = $this->_conn->prepare($sql);
		$this->_query->execute();
	}
	function one(){
		return $this->_query->fetch(PDO::FETCH_OBJ);
	}
	function all(){
		while($list = $this->_query->fetch(PDO::FETCH_OBJ)){
			$data[] = $list;
		}
		return $data;
	}
}

