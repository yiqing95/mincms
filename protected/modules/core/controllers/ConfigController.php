<?php namespace app\modules\core\controllers; 
use app\modules\core\models\Config; 
/**
*   
* 
* @author Sun < mincms@outlook.com >
*/
class ConfigController extends \app\core\AuthController
{ 
	function init(){
		parent::init();
		$this->active = array('system','auth.config.index');
	}
	public function actionCreate()
	{  
		$this->view->title = __('create config');
		$model = new Config();
	 	$model->scenario = 'all';
		if ($this->populate($_POST, $model) && $model->validate()) { 
		 	$model->save();
		 	flash('success',__('create config sucessful'));
			refresh();
		} 
		echo $this->render('form', array(
		   'model' => $model,
		   'name'=>'user_create', 
		));
	}
	public function actionUpdate($id)
	{  
		$this->view->title = __('update config') ."#".$id;
		$model = Config::find($id);
	 	$model->scenario = 'all';
		if ($this->populate($_POST, $model) && $model->validate()) { 
		 	$model->save();
		 	flash('success',__('update config sucessful'));
			refresh();
		} 
		echo $this->render('form', array(
		   'model' => $model, 
		   'name'=>'user_update',
		));
	}
	public function actionDelete($id){
		if($_POST['action']==1){ 
			$model = Config::find($id); 
			$model->delete();
			echo json_encode(array('id'=>array($id),'class'=>'alert-success','message'=>__('delete config success')));
			exit;
		} 
	}
	public function actionIndex()
	{    
		$rt = \app\core\Pagination::run('\app\modules\core\models\Config');  
 		
		echo $this->render('index', array(
		   'models' => $rt->models,
		   'pages' => $rt->pages,
		));
	}

	 
}
