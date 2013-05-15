<?php
/**
* 数据库还原
*/
include 'mysql.php';
$db->query("SHOW TABLES");
$tables = $db->get();
 
$db->query("SHOW VARIABLES LIKE '%basedir%'");
$row = $db->first();
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
$HOST = substr($HOST,strpos($HOST,'host=')+5);
$HOST = substr($HOST,0,strpos($HOST,';'));
 
$path = dirname(__FILE__)."/backup";
$dir = $path."/{$DATABASE}_";
$file = $dir.date('Ymd-H-i-s',time()).'.sql';

$list = scandir(dirname(__FILE__)."/backup");
foreach($list as $vo){
	if($vo !="."&& $vo !=".." && $vo !=".svn" )
	{
		$find[$vo]=filemtime($path.'/'.$vo);
	}
}

krsort($find);
if($_GET['id']){
$name = base64_decode($_GET['id']);
$restore = $path."/".$name;
if(!file_exists($restore)) exit('file not exists');
if($tables){
	foreach($tables as $t){
		foreach($t as $n){
			$sql = "drop table $n";
			$db->query($sql);
		}
	}
}
$sql = "{$bin}mysql -h $HOST -u $USERNAME --password=$PASSWORD $DATABASE < $restore";
header('Location: restore.php');
@exec($sql);
} 
 
?>
<link href="../misc/bootstrap\css/bootstrap.css" rel="stylesheet">
<blockquote><h3>Cover Database</h3></blockquote>
<table class="table table-bordered">
<thead>
<tr>
<th>Database Name</th>
<th>Time</th>
<th>Cover</th>
</tr>
</thead>
<tbody>
<?php foreach($find as $vo=>$time){?>
<tr>
<td><?php echo $vo;?></td>
<td><?php echo date('Y-m-d H:i:s',$time);?></td>
<td><a href="?id=<?php echo base64_encode($vo);?>">Cover IT</a></td>
</tr>
<?php }?>
</tbody>
</table>