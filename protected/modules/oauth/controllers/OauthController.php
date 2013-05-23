<?php
/**
 * MinCMS - An  content manage base on 
 * @author   MinCMS Team <admin@mincms.com | qq¹Ù·½Èº: 40933125>
 * @Coprighty  http://mincms.com
 */
class OauthController extends SAdminController
{
	public $mytype;
	function init(){
		parent::init(); 
		$this->mytype =  @include dirname(__FILE__).'/../config.php'; 
		$this->active_menu = 'member/admin/index';
		
	}
 	public function actionIndex()
	{
		$this->plugin('uisort',array(
	        'table'=>'member_login_oauth', 
	        'url'=>url('member/oauth/index'), 
	    ));
	    if(!$_GET['uisort_member_login_oauth']){ 
			$model=new MemberLoginOauth('search');
			$model->unsetAttributes(); 
			if(isset($_GET['MemberLoginOauth']))
				$model->attributes=$_GET['MemberLoginOauth'];

			$this->render('index',array(
				'model'=>$model,
			));
		}
	}

	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
	
	public function actionActive($id)
	{ 
		$id = (int)$id;
		if(!$id){
			throw new CHttpException(404,__('bad request'));
		}
		$model = $this->loadModel($id); 
		$d = $model->active;
		if($d == 1)
			$d = 0;
		else
			$d = 1;
		$sql = "update {{member_login_oauth}} set active = $d where id=$id";
		Yii::app()->db->createCommand($sql)->execute();
		flash('success',__('Success'));
	 
		
		$this->redirect(array('index'));
		
	}

	public function actionCreate()
	{
		$m = MemberLoginOauth::model()->findAll();
		$a  = $this->to_array($m,'id','type'); 
		if($a){  
			foreach($a as $k=>$v){
				unset($this->mytype[$v]);
			}
		}
		
		$model=new MemberLoginOauth;

		$this->performAjaxValidation($model);

		if(isset($_POST['MemberLoginOauth']))
		{
			$model->attributes=$_POST['MemberLoginOauth'];
			if($model->save()){
				flash('success',__('Success'));
				$this->redirect(array('index'));
			}
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		$this->performAjaxValidation($model);

		if(isset($_POST['MemberLoginOauth']))
		{
			$model->attributes=$_POST['MemberLoginOauth'];
			if($model->save()){
				flash('success',__('Success'));
				$this->redirect(array('index'));
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			$this->loadModel($id)->delete();

			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

 
	

	public function loadModel($id)
	{
		$model=MemberLoginOauth::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,__('The requested page does not exist.'));
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
