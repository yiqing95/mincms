<?php namespace app\modules\auth\controllers; 
/**
*  auth module default controller
* 
* @author Sun < taichiquan@outlook.com >
*/
class SiteController extends \app\core\AuthController
{ 
	public function actionIndex()
	{ 
		echo $this->render('index');
	}

	 
}
