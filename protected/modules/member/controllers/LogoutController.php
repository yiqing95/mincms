<?php namespace app\modules\member\controllers; 
use app\modules\member\Auth;
/**
 *  
 * @author Sun < mincms@outlook.com >
 * @Coprighty  http://mincms.com
 */
class LogoutController extends \app\core\FrontController
{
 
	public function actionIndex()
	{
		Auth::logout();
		flash('success',__('logout success'));
		$this->redirect(return_url());
	}
	

	 
}
