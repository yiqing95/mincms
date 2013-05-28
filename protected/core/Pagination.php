<?php namespace app\core;  
/**
* @author Sun < taichiquan@outlook.com >
*/
class Pagination  
{ 
	static function run($model){ 
		$query = $model::find();
		$countQuery = clone $query;
		$pages = new \yii\web\Pagination($countQuery->count());
		$models = $query->offset($pages->offset)
		  ->limit($pages->limit)
		  ->all();
		return (object)array(
			'pages'=>$pages,
			'models'=>$models
		);
	}
}