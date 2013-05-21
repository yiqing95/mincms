<?php namespace app\core;  
/**
*  \yii\db\Query
* 
* @author Sun < taichiquan@outlook.com >
*/
class Query extends \yii\db\Query
{ 
	public function createCommand($db = null)
	{
		if ($db === null) {
			$db = \Yii::$app->db;
		}
		$sql = $db->getQueryBuilder()->build($this);
		return $db->createCommand($sql, $this->params);
	}

	function one(){
		$command = $this->createCommand(); 
		return $command->queryRow();
	}
	function all(){
		$command = $this->createCommand(); 
		return $command->queryAll();
	}
}