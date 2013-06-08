<?php namespace app\modules\content\controllers; 
use app\modules\content\models\Field;
use app\modules\content\models\Widget;
/** 
* @author Sun < mincms@outlook.com >
*/
class SiteController extends \app\core\AuthController
{ 
	public $widget;
	function init(){
		parent::init();
		$this->active = array('content','content.site.index');
		$this->widget = Field::widgets();
		$first[0] = __('please select');
		$this->widget = $first+$this->widget;
	}
	public function actionCreate()
	{  
		$this->view->title = __('create content type');
		$model = new Field();
	 	$model->scenario = 'all';
		if ($this->populate($_POST, $model) && $model->validate()) { 
		 	$model->save();
		 	flash('success',__('create sucessful'));
			refresh();
		} 
		echo $this->render('form', array(
		   'model' => $model,
		   'name'=>'content', 
		   'widget'=>$this->widget
		));
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
	public function actionIndex()
	{    
		$rt = \app\core\Pagination::run('\app\modules\content\models\Field','active');  
 		
		echo $this->render('index', array(
		   'models' => $rt->models,
		   'pages' => $rt->pages,
		));
	}

	 
}
