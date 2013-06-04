<?php namespace app\modules\content\controllers;   
use app\modules\content\models\Field;
use app\modules\content\models\Widget;
use app\modules\content\models\FormBuilder;
/** 
* @author Sun < taichiquan@outlook.com >
*/
class NodeController extends \app\core\AuthController
{ 
 	
	function init(){
		parent::init();
		$this->active = array('content','content.node.index'); 
	}
	public function actionCreate()
	{  
		$this->view->title = __('create content');
		echo $this->render('form');
	}
	public function actionUpdate($id)
	{  
		$this->view->title = __('update content type') ."#".$id;
		$model = Field::find($id);
	 	$model->scenario = 'all';
		if ($this->populate($_POST, $model) && $model->validate()) { 
		 	$model->save(); 
		 	flash('success',__('update sucessful'));
			refresh();
		} 
		echo $this->render('form', array(
		   'model' => $model, 
		   'name'=>'content',
		   'widget'=>$this->widget
		));
	}
	public function actionDelete($id){
		if($_POST['action']==1){ 
			$model = Field::find($id); 
			$model->delete();
			echo json_encode(array('id'=>array($id),'class'=>'alert-success','message'=>__('delete success')));
			exit;
		} 
	}
	public function actionIndex($name='posts')
	{    
		new FormBuilder('post');
		$rt = \app\core\Pagination::run('\app\modules\content\models\NodeActiveRecord');  
 		
		echo $this->render('index', array(
		   'models' => $rt->models,
		   'pages' => $rt->pages,
		));
	}

	 
}
