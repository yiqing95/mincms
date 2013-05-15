<?php namespace app\core;
/**
*  all admin controllers should be exnteds this controller
* 
* @author Sun < taichiquan@outlook.com >
*/ 
class AuthController extends Controller
{ 
	function init(){
		parent::init(); 
	 	language('language_');  
		if(\Yii::$app->user->isGuest){
			flash('error',__('Please Login First'));
			redirect(url('auth/open/login'));
		}
	}

	 
}
