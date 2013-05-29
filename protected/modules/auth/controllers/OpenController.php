<?php namespace app\modules\auth\controllers;
/**
*  veryone can visit 
* 
* @author Sun < taichiquan@outlook.com >
*/
use app\core\FrontController;
use app\modules\auth\models\LoginForm; 
 

class OpenController extends FrontController
{ 
	public function actions()
	{
		return array(
			'captcha' => array(
				'class' => 'yii\web\CaptchaAction',
			),
		);
	}
	
	public function actionLogin()
	{
		$model = new LoginForm();
		if ($this->populate($_POST, $model) && $model->login()) {
			redirect(array('core/config/index'));
		} else {
			echo $this->render('login', array(
				'model' => $model,
			));
		}
	}

	public function actionLogout()
	{
		\Yii::$app->getUser()->logout();
		redirect(array('site/index'));
	}

	 
}
