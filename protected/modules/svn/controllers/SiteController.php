<?php namespace app\modules\svn\controllers; 
/**
*  svn
* 
* @author Sun < mincms@outlook.com >
*/
class SiteController extends \app\core\AuthController
{ 
	public function actionIndex()
	{ 
		 $path = \Yii::$app->basePath.'/../';
		 exec("svn update ".$path); 
		 $e = system("svn status -v ".$path);
		 dump($e);
	}

	 
}
