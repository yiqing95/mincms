<?php namespace app\modules\media\controllers;
/**
*  
* 
* @author Sun < taichiquan@outlook.com >
*/
 
 

class PostController extends \app\core\AuthController
{ 
	  

	public function actionIndex()
	{
		$file = root_path().'upload/1.jpg';
 	 	$d = exif_read_data  ($file);  
	 	dump($d);
	}

	 
}
