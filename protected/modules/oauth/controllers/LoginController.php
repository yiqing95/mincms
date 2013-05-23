<?php
/**
 * MinCMS - An  content manage base on 
 * @author   MinCMS Team <admin@mincms.com | qq¹Ù·½Èº: 40933125>
 * @Coprighty  http://mincms.com
 */
class LoginController extends SAdminController
{
 	function init(){
 		parent::init();
 		$this->active_menu = 'member/admin/index';
 	}
	 
 	public function actionIndex()
	{
		$model=new MemberLoginThird('search');
		$model->unsetAttributes(); 
		if(isset($_GET['MemberLoginThird']))
			$model->attributes=$_GET['MemberLoginThird'];

		$this->render('index',array(
			'model'=>$model,
		));
	}

 
}
