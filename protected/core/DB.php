<?php namespace app\core;  
/** 
* 具体参数可参考
* https://github.com/yiisoft/yii2/blob/master/framework/yii/db/QueryBuilder.php
*
* @author Sun < taichiquan@outlook.com >
* @date 2013
*/
class DB{
	static function one($table,$getway=array()){
		$command = static::_query($table,$getway);
		return $command->queryRow(); 
	}
	static function all($table,$getway=array()){
		$command = static::_query($table,$getway);
		return $command->queryAll();  
	}
	
	static function insert($table,$data=array(),){ 
		return \Yii::$app->db->createCommand()
			->insert($table,$data);   	
	}
	/**
	*  
	* 其中$condition
	```
	* array(
	* 	'id=:id',
	*		array( ':id'=>$node_id)
	* ))
	```
	*/
	static function update($table,$data=array(),$condition=array()){ 
		return \Yii::$app->db->createCommand()
			->update($table,$data,$condition);   	
	}
	static function delete($table, $condition, &$params){ 
		return \Yii::$app->db->createCommand()
			->delete($table, $condition, $params);   	
	}
	static function _query($table,$getway=array()){ 
		$query = new \yii\db\Query;
		$query = $query->from($table);
		if($getway){
			foreach ($getway as $key => $value) {
				$query = $query->$key($value); 
			}
		} 
		return $query->createCommand(); 
		$row = $command->queryAll();  
	}
}