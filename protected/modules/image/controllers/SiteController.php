<?php namespace app\modules\image\controllers; 
/**
*  
RewriteCond %{REQUEST_FILENAME} !\.(jpg|jpeg|png|gif|bmp)$ 
RewriteRule upload/imagecache/(.*)$ /image.html?id=upload/$1 [NC,R,L]   
* @author Sun < taichiquan@outlook.com >
*/
class SiteController extends \app\core\AuthController
{ 
	public function actionIndex()
	{ 
		echo $this->render('index');
	}

	 
}
