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
	
	static function insert($table,$data=array()){ 
		return \Yii::$app->db->createCommand()
			->insert($table,$data)->execute();   	
	}
	static function batchInsert($table, $columns, $rows){ 
		return \Yii::$app->db->createCommand()
			->batchInsert($table, $columns, $rows)->execute();   	
	}
	static function id(){ 
		return \Yii::$app->db->getLastInsertID();
	}
	/** 
	<div class='pagination'>
	<?php  echo \app\core\LinkPager::widget(array(
	      'pagination' => $pages,
	  ));?>
	</div>
	*/
	static function pagination($table,$params=array(),$route=null){
		$one = static::one($table,array(
			'select'=>'count(*) count'
		));
		$count = $one['count'];
		
		$pages = new \yii\data\Pagination($count);
		if($route)
			$pages->route = $route;
		$params['offset'] = $pages->offset;
		$params['limit'] = $pages->limit; 
     	$models = static::all($table,$params);
     	return (object)array(
			'pages'=>$pages,
			'models'=>$models
		);
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
	static function update($table, $columns, $condition = '', $params = array()){ 
		return \Yii::$app->db->createCommand()
			->update($table,$columns,$condition,$params)->execute();   	
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