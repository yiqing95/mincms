<?php namespace app\modules\member\controllers; 
/**
*  购物车，只有管理员看到
*  如是会员才能看到的 extends app\modules\member\AuthController
*  如是管理员才能看到的 extends \app\core\AuthController
* 
* @author Sun < mincms@outlook.com >
*/
class SiteController extends \app\core\AuthController
{ 
	public function actionIndex()
	{ 
		echo $this->render('index');
	}

	 
}
