<?php namespace app\modules\cart\controllers; 
/**
*   
* @author Sun < mincms@outlook.com >
*/
class TestController extends \app\core\AuthController
{ 
	public function actionIndex()
	{ 
		echo $this->render('index');
	}

	 
}
