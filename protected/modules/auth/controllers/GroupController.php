<?php namespace app\modules\auth\controllers; 
/**
*  ÓÃ»§×é
* 
* @author Sun < taichiquan@outlook.com >
*/
class GroupController extends \app\core\AuthController
{ 
	public function actionCreate()
	{   
		$this->view->title = __('create group');
		$model = new \app\modules\auth\models\Group();
	 	$model->scenario = 'create';
		if ($this->populate($_POST, $model) && $model->validate()) { 
		 	$model->save();
		 	flash('success',__('create group sucessful'));
			refresh();
		} 
		echo $this->render('form', array(
		   'model' => $model,
		   'name'=>'group_create', 
		));
	}
	public function actionUpdate($id)
	{   
		$this->view->title = __('update group');
		$model = \app\modules\auth\models\Group::find($id);
	 	$model->scenario = 'update';
		if ($this->populate($_POST, $model) && $model->validate()) { 
		 	$model->save();
		 	flash('success',__('update group sucessful'));
			refresh();
		} 
		echo $this->render('form', array(
		   'model' => $model, 
		   'name'=>'group_create',
		));
	}
	public function actionDelete($id){
		if($_POST['action']==1){
			$model = \app\modules\auth\models\Group::find($id); 
			$ids =  $model->delete_ids;
			$model->delete();
			$n = " #".implode('_',$ids);
			echo json_encode(array('id'=>$ids,'class'=>'alert-success','message'=>__('delete group success').$n ));
			exit;
		} 
	}
	public function actionIndex()
	{   
		$query = \app\modules\auth\models\Group::find();
		$countQuery = clone $query;
		$pages = new \yii\web\Pagination($countQuery->count());
		$models = $query->offset($pages->offset)
		  ->limit($pages->limit)
		  ->all();
 		
		echo $this->render('index', array(
		   'models' => $models,
		   'pages' => $pages,
		));
	}

	 
}
