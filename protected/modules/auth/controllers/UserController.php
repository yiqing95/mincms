<?php namespace app\modules\auth\controllers; 
/**
*  管理员管理
* 
* @author Sun < taichiquan@outlook.com >
*/
class UserController extends \app\core\AuthController
{ 
	function init(){
		parent::init();
		$this->active = array('auth','auth.user.index');
	}
	public function actionCreate()
	{  
		$this->view->title = __('create user');
		$model = new \app\modules\auth\models\User();
	 	$model->scenario = 'create';
		if ($this->populate($_POST, $model) && $model->validate()) { 
		 	$model->save();
		 	flash('success',__('create user sucessful'));
			refresh();
		} 
		echo $this->render('form', array(
		   'model' => $model,
		   'name'=>'user_create', 
		));
	}
	public function actionUpdate($id)
	{  
		$this->view->title = __('update user') ."#".$id;
		$model = \app\modules\auth\models\User::find($id);
	 	$model->scenario = 'update';
		if ($this->populate($_POST, $model) && $model->validate()) { 
		 	$model->save();
		 	flash('success',__('update password sucessful'));
			refresh();
		} 
		echo $this->render('form', array(
		   'model' => $model, 
		   'name'=>'user_update',
		));
	}
	public function actionDelete($id){
		if($_POST['action']==1){
			if($id==1){
				echo json_encode(array('id'=>array(0),'class'=>'alert-error','message'=>__('supper user can not delete')));
 				exit;
			}
			if($id === uid()){ 
				echo json_encode(array('id'=>array(0),'class'=>'alert-error','message'=>__('you can not remove yourself')));
				exit;
			}
			$model = \app\modules\auth\models\User::find($id); 
			$model->delete();
			echo json_encode(array('id'=>array($id),'class'=>'alert-success','message'=>__('delete user success')));
			exit;
		} 
	}
	public function actionIndex()
	{    
		$rt = \app\core\Pagination::run('\app\modules\auth\models\User');  
 		
		echo $this->render('index', array(
		   'models' => $rt->models,
		   'pages' => $rt->pages,
		));
	}

	 
}
