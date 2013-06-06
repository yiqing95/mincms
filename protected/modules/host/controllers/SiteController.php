<?php namespace app\modules\host\controllers; 
use app\modules\host\models\Host;
use app\modules\core\Classes;
use app\core\DB;
/**
*  
* @author Sun < taichiquan@outlook.com >
*/
class SiteController extends \app\core\AuthController
{ 
	public $config_key = 'module_host';
	function init(){
		parent::init();
		$this->active = array('extend','host.site.index'); 
	}
	function actionConfig(){ 
		$value = Classes::get_config($this->config_key);
		
		if($value==1)
			$value = 0;
		else
			$value = 1;
		Classes::set_config($this->config_key,$value);
		cache_pre_delete('hooks');
		flash('success',__('sucessful'));
		$this->redirect(url('host/site/index'));
	}
	function actionSort(){ 
 		$ids = $sort = $_POST['ids']; 
 		arsort($sort); 
 		$sort = array_merge($sort,array()); 
 		$table = "host";
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
	function actionDisplay($id){
		$id = (int)$id;
		if($id<1) exit;
		$one = DB::one('host',array(
			'where'=>array('id'=>$id)
		));
		$display = $one['display']==1?0:1;
		DB::update('oauth_config',array(
			'display'=>$display
		),'id=:id',array(':id'=>$id));
		flash('success',__('sucessful'));
		$this->redirect(url('host/site/index'));
	}
	public function actionCreate()
	{  
		$this->view->title = __('create host');
		$model = new Host();
	 	$model->scenario = 'all';
		if ($this->populate($_POST, $model) && $model->validate()) { 
		 	$model->save();
		 	flash('success',__('create sucessful'));
			$this->redirect(url('host/site/index'));
		} 
		echo $this->render('form', array(
		   'model' => $model 
		));
	}
	public function actionUpdate($id)
	{  
		$this->view->title = __('update host') ."#".$id;
		$model = Host::find($id);
	 	$model->scenario = 'all';
		if ($this->populate($_POST, $model) && $model->validate()) { 
		 	$model->save();
		 	flash('success',__('update sucessful'));
			$this->redirect(url('host/site/index'));
		} 
		echo $this->render('form', array(
		   'model' => $model,  
		));
	}
	public function actionDelete($id){
		if($_POST['action']==1){ 
			$model = Host::find($id); 
			$model->delete();
			echo json_encode(array('id'=>array($id),'class'=>'alert-success','message'=>__('delete success')));
			exit;
		} 
	}
	public function actionIndex()
	{    
		$value = Classes::get_config($this->config_key);
		$rt = \app\core\Pagination::run('\app\modules\host\models\Host',array('orderBy'=>'sort desc,id desc'),array('pageSize'=>50));  
 		
		echo $this->render('index', array(
		   'models' => $rt->models,
		   'pages' => $rt->pages,
		   'value'=>$value,
		));
	}
	 
}
