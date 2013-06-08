<?php namespace app\core;  
use yii\base\Theme; 
/**
*  default controller
* 
* @author Sun < mincms@outlook.com >
*/
class Controller extends \yii\web\Controller
{ 
	public $theme = 'classic';
	//启用的菜单
	public $active;
	function init(){
		parent::init();  
		language(); 
		hook('controller'); 
		/*
		* load modules 
		* 加载模块
		*/
		if(!cache_pre('all_modules'))
			\app\core\Modules::load();  
	}
	
	function redirect($url){
		return redirect($url);
	}
}