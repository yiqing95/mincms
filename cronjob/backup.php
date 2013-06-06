<?php 
/**
* 数据库备份
*/
include 'mysql.php';
 
$db->query("SHOW VARIABLES LIKE '%basedir%'");
$row = $db->one();
foreach($row as $k=>$v){
	$k = strtolower($k);
	if($k=='value')
		$bin = $v.'/bin/';
}
if(!$bin) exit;
$HOST = $mysql['dsn'];
$USERNAME = $mysql['username'];
$PASSWORD = $mysql['password'];
$DATABASE = substr($HOST,strrpos($HOST,'dbname=')+7);
$dir = dirname(__FILE__)."/backup/{$DATABASE}_";
$file = $dir.date('Ymd-H-i-s',time()).'.sql';
$sql = "{$bin}mysqldump -u$USERNAME -p$PASSWORD $DATABASE > $file ";
 
@exec($sql); 