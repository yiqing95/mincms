<?php namespace app\modules\comment\controllers; 
use app\modules\comment\models\CommentFilter;
use app\core\DB;
/**
*   
* 
* @author Sun < mincms@outlook.com >
*/
class FilterController extends \app\core\AuthController
{ 
	function init(){
		parent::init();
		$this->active = array('extend','comment.site.index'); 
	}
	  
	public function actionCreate()
	{  
		$this->view->title = __('create comment filter');
		$model = new Filter();
	 	$model->scenario = 'all';
		if ($this->populate($_POST, $model) && $model->validate()) { 
		 	$model->save();
		 	flash('success',__('create sucessful'));
			$this->redirect(url('comment/filter/index'));
		} 
		echo $this->render('form', array(
		   'model' => $model,
		   'name'=>'comment_filter', 
		));
	}
	public function actionUpdate($id)
	{  
		$this->view->title = __('update comment filter') ."#".$id;
		$model = Filter::find($id);
	 	$model->scenario = 'all';
		if ($this->populate($_POST, $model) && $model->validate()) { 
		 	$model->save();
		 	flash('success',__('update sucessful'));
			$this->redirect(url('comment/filter/index'));
		} 
		echo $this->render('form', array(
		   'model' => $model, 
		   'name'=>'comment_filter',
		));
	}
	public function actionDelete($id){
		if($_POST['action']==1){ 
			$model = CommentFilter::find($id); 
			$model->delete();
			echo json_encode(array('id'=>array($id),'class'=>'alert-success','message'=>__('delete success')));
			exit;
		} 
	}
	public function actionIndex()
	{    
		$rt = \app\core\Pagination::run('\app\modules\comment\models\Filter');  
 		
		echo $this->render('index', array(
		   'models' => $rt->models,
		   'pages' => $rt->pages,
		));
	}

	 
}
