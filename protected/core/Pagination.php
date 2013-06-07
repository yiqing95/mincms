<?php namespace app\core;  

/**
public static function active($query)
{
	$pid = (int)$_GET['pid']?:0;
    $query->andWhere('pid = '.$pid);
}
<div class='pagination'>
<?php  echo \yii\widgets\LinkPager::widget(array(
      'pagination' => $pages,
  ));?>
</div>
* @author Sun < taichiquan@outlook.com >
*/
class Pagination  
{  
	static function run($model,$scope=null,$config=array('pageSize'=>10)){ 
		$query = $model::find();
		$countQuery = clone $query;
		$pages = new \yii\data\Pagination($countQuery->count(),$config);
		$models = $query->offset($pages->offset)
		  ->limit($pages->limit);
		if($scope){
			if(is_string($scope)){
				$models = $models->$scope();
			}else{
				foreach($scope as $k=>$v){
					if(!is_numeric($k))
						$models = $models->$k($v);
					else
						$models = $models->$v();
				}
			}
		}
		$models = $models->all();
		return (object)array(
			'pages'=>$pages,
			'models'=>$models
		);
	}
}