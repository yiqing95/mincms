<?php namespace app\modules\auth\controllers; 
use \app\modules\auth\models\Group;
use \app\modules\auth\models\UserGroup;
use \app\core\Arr;
/**
*  用户组
* 
* @author Sun < taichiquan@outlook.com >
*/
class GroupController extends \app\core\AuthController
{ 
	function init(){
		parent::init();
		$this->active = array('auth','auth.group.index');
	}
	/**
	* 用户绑定到组
	*/
	public function actionBind($id)
	{ 	
		$id = (int)$id;
		$model = \app\modules\auth\models\User::find($id);
		foreach($model->groups as $g){
			$groups[] =  $g->group_id;
		}  
		$rows = Group::find()->all();
		if($rows)
			$rows = Arr::model_tree($rows); 
 	 	if($_POST){
 	 		$group = $_POST['group'];
 	 	 	//绑定用户到组
 	 		UserGroup::UserGroupSave($id,$group); 
 	 		flash('success',__('bin user group success'). " # ".$id);
 	 		redirect(url('auth/group/bind',array('id'=>$id))); 
 	 	}
 	  
		echo $this->render('bind',array(
			'rows'=>$rows, 
			'groups'=>$groups,
			'model'=>$model,
			'id'=>$id,
		 	'self'=>$model->yourself
		));
	}
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
		$rt = \app\core\Pagination::run('Group'); 
		echo $this->render('index', array(
		   'models' => $rt->models,
		   'pages' => $rt->pages,
		));
	}

	 
}
