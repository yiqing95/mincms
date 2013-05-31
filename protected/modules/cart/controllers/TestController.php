<?php namespace app\modules\cart\controllers; 
/**
*   
* @author Sun < taichiquan@outlook.com >
*/
class TestController extends \app\core\AuthController
{ 
	public function actionIndex()
	{ 
		echo $this->render('index');
	}

	 
}
