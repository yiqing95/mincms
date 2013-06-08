<?php namespace app\modules\file\controllers;
use app\core\File;
/**
*  
* 
* @author Sun < mincms@outlook.com >
*/ 
class SiteController extends \app\core\AuthController
{ 
	  

	public function actionIndex()
	{
		//$file = root_path().'upload/1.jpg';
 	 	//$d = exif_read_data  ($file);  
	 	echo $this->render('index');
	}
	/**
	* 管理员上传
	*/
	function actionUpload(){
		$name = $_REQUEST['field']; 
 		if(!$name) exit;
 		$file = new File;
 		$file->uid = uid();
 		$file->admin = 1;
		$rt = $file->upload();  
		
		if(!$rt) return; 
		$new[] = $rt;  
		$out = File::input($new,$name);
		$rt->tag = $out;
		die(json_encode($rt)); 
	}

	 
}
