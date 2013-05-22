<?php

use app\core\Controller;
use app\models\LoginForm;
use app\models\ContactForm;
use app\modules\auth\models\User;
class SiteController extends Controller
{
	
	public function actions()
	{
		return array(
			'captcha' => array(
				'class' => 'yii\web\CaptchaAction',
			),
		);
	}

	public function actionIndex()
	{ 
		 
		echo $this->render('index');
	} 

	public function actionContact()
	{
		$model = new ContactForm;
		if ($this->populate($_POST, $model) && $model->contact(Yii::$app->params['adminEmail'])) {
			Yii::$app->session->setFlash('contactFormSubmitted');
			Yii::$app->response->refresh();
		} else {
			echo $this->render('contact', array(
				'model' => $model,
			));
		}
	}

	public function actionAbout()
	{
		/*$user = new User();
		$user->username = 'admin2';
		$user->password = 'admin';
		$user->email = '68103403@qq.com';
		$user->save();*/
		
		$query = User::find();
		$countQuery = clone $query;
		$pages = new yii\web\Pagination($countQuery->count());
		$models = $query->offset($pages->offset)
		  ->limit($pages->limit)
		  ->all();

		echo $this->render('about', array(
		   'models' => $models,
		   'pages' => $pages,
		));
	 
	}
}
