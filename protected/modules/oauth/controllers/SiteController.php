<?php namespace app\modules\oauth\controllers; 
use app\modules\oauth\models\OauthConfig;
use app\core\DB;
/**
*   
* 
* @author Sun < taichiquan@outlook.com >
*/
class SiteController extends \app\core\AuthController
{ 
	function init(){
		parent::init();
		$this->active = array('extend','oauth.site.index');
	}
	function actionDisplay($id){
		$id = (int)$id;
		if($id<1) exit;
		$one = DB::one('oauth_config',array(
			'where'=>array('id'=>$id)
		));
		$display = $one['display']==1?0:1;
		DB::update('oauth_config',array(
			'display'=>$display
		),'id=:id',array(':id'=>$id));
		flash('success',__('sucessful'));
		$this->redirect(url('oauth/site/index'));
	}
	public function actionCreate()
	{  
		$this->view->title = __('create oauth');
		$model = new OauthConfig();
	 	$model->scenario = 'all';
		if ($this->populate($_POST, $model) && $model->validate()) { 
		 	$model->save();
		 	flash('success',__('create sucessful'));
			$this->redirect(url('oauth/site/index'));
		} 
		echo $this->render('form', array(
		   'model' => $model,
		   'name'=>'oauth_config', 
		));
	}
	public function actionUpdate($id)
	{  
		$this->view->title = __('update oauth') ."#".$id;
		$model = OauthConfig::find($id);
	 	$model->scenario = 'all';
		if ($this->populate($_POST, $model) && $model->validate()) { 
		 	$model->save();
		 	flash('success',__('update sucessful'));
			$this->redirect(url('oauth/site/index'));
		} 
		echo $this->render('form', array(
		   'model' => $model, 
		   'name'=>'oauth_config',
		));
	}
	public function actionDelete($id){
		if($_POST['action']==1){ 
			$model = OauthConfig::find($id); 
			$model->delete();
			echo json_encode(array('id'=>array($id),'class'=>'alert-success','message'=>__('delete success')));
			exit;
		} 
	}
	public function actionIndex()
	{    
		$rt = \app\core\Pagination::run('\app\modules\oauth\models\OauthConfig');  
 		
		echo $this->render('index', array(
		   'models' => $rt->models,
		   'pages' => $rt->pages,
		));
	}

	 
}
