<?php namespace app\modules\comment\controllers; 
use app\modules\comment\models\CommentFilter;
use app\core\DB;
/**
*   
* 
* @author Sun < mincms@outlook.com >
*/
class SiteController extends \app\core\AuthController
{ 
	function init(){
		parent::init();
		$this->active = array('extend','comment.site.index'); 
	} 
	function actionSort(){ 
 		$ids = $sort = $_POST['ids']; 
 		arsort($sort); 
 		$sort = array_merge($sort,array()); 
 		$table = "comment";
 		$fid = $id; 
 		foreach($ids as $k=>$id){ 
 		 	DB::update($table,
	 			array(
	 				'sort'=>$sort[$k]
	 			),'id=:id', array(':id'=>$id)
 		 	); 
 		}  
 	  
 		return 1;
 		
  
	}
	function actionDisplay($id,$form){
		$id = (int)$id;
		if($id<1) exit;
		$one = DB::one('comment',array(
			'where'=>array('id'=>$id)
		));
		$display = $one['display']==1?0:1;
		DB::update('comment',array(
			'display'=>$display
		),'id=:id',array(':id'=>$id));
		flash('success',__('sucessful'));
		$this->redirect(url('comment/site/index',array('form'=>$form)));
	}
	public function actionDelete($id){
		if($_POST['action']==1){ 
			$model = Comment::find($id); 
			$model->delete();
			echo json_encode(array('id'=>array($id),'class'=>'alert-success','message'=>__('delete success')));
			exit;
		} 
	}
	public function actionIndex()
	{   
		$form = $_GET['form'];
		if($form){
			$rt = \app\core\Pagination::run('\app\modules\comment\models\Comment',array(
				'orderBy'=>'sort desc,id desc'
			));
		}
		else
			$rt = \app\core\Pagination::run('\app\modules\comment\models\Slug');  
 		
		echo $this->render('index', array(
		   'models' => $rt->models,
		   'pages' => $rt->pages,
		   'form'=>$form
		));
	}

	 
}
