<?php
/**
 * MinCMS - An  content manage base on 
 * @author   MinCMS Team <admin@mincms.com | qq¹Ù·½Èº: 40933125>
 * @Coprighty  http://mincms.com
 */
class LogoutController extends Controller
{
 
	public function actionIndex()
	{
		Yii::app()->user->logout();
		flash('success',__('you had logout,it is safe logout'));
		$this->redirect(return_url());
	}
	

	 
}
