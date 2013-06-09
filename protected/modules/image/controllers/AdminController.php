<?php namespace app\modules\image\controllers;  
use app\modules\image\models\Image;
 
/**
* 公共可访问控制器，自动生成图片需要的效果
*  
* @author Sun < mincms@outlook.com >
*/
class AdminController extends \app\core\AuthController
{ 
	public $imagecache;
	function init(){
		parent::init();
		$this->imagecache = array(
			'resize'=>array(
				'width'=>'',
				'height'=>'',
				'keepar'=>"true",
				'pad'=>"true",
			),
			'crop'=>array(
				'x1'=>'',
				'y1'=>'',
				'x2'=>'',
				'y2'=>'',
			),
			'crop_resize'=>array(
				'width'=>'',
				'height'=>'', 
			),
			'rotate'=>array(
				'degrees'=>'',
			),
			'flip'=>array(
				'direction'=>array(
					'vertical','horizontal','both'
				), 
			),
			'watermark'=>array(
				'filename'=>'file',
				'position'=>array(
					1,2,3,4,5,6,7,8,9
				),
				'padding'=>'',
			),
			'border'=>array(
				'size'=>'',
				'color'=>'color', 
			),
			'mask'=>array(
				'maskimage'=>'mask.ext', 
			),
			'rounded'=>array(
				'radius'=>'',
				'sides'=>'tl tr bl br',
				'antialias'=>'', 
			),
			'grayscale'=>array(
				'grayscale' 
			),
		);
		$this->active = array('system','image.admin.index');
	}
	 
	public function actionCreate()
	{  
		$this->view->title = __('create image');
		$model = new Image();
	 	$model->scenario = 'all';
		if ($this->populate($_POST, $model) && $model->validate()) { 
		 	$model->save();
		 	flash('success',__('create sucessful'));
			$this->redirect(url('image/admin/index'));
		} 
		echo $this->render('form', array(
		   'model' => $model, 
		   'image' => array_keys($this->imagecache)
		));
	}
	public function actionUpdate($id)
	{  
		$this->view->title = __('update image') ."#".$id;
		$model = Image::find($id);
	 	$model->scenario = 'all';
		if ($this->populate($_POST, $model) && $model->validate()) { 
		 	$model->save();
		 	flash('success',__('update sucessful'));
			$this->redirect(url('image/admin/index'));
		} 
		echo $this->render('form', array(
		   'model' => $model, 
		   'image' => $this->imagecache
		));
	}
	public function actionDelete($id){
		if($_POST['action']==1){ 
			$model = Image::find($id); 
			$model->delete();
			echo json_encode(array('id'=>array($id),'class'=>'alert-success','message'=>__('delete success')));
			exit;
		} 
	}
	public function actionIndex()
	{    
		$rt = \app\core\Pagination::run('\app\modules\image\models\Image',null,array('pageSize'=>50));  
 		
		echo $this->render('index', array(
		   'models' => $rt->models,
		   'pages' => $rt->pages,
		));
	}
}
