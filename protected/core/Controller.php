<?php namespace app\core;  
use yii\base\Theme;
/**
*  default controller
* 
* @author Sun < taichiquan@outlook.com >
*/
class Controller extends \yii\web\Controller
{ 
	public $theme = 'classic';
	//启用的菜单
	public $active;
	function init(){
		parent::init();  
		language(); 
		/*
		* load modules 
		* 加载模块
		*/
		if(!cache_pre('all_modules'))
			$this->_modules(); 
		
	}
	/*
	* load modules 
	* 加载模块
	*/
	function _modules(){
		$all = DB::all('core_modules',array(
			'where'=>array('active'=>1),
			'orderBy'=>'sort desc,id asc',
		));
	 	 
		foreach($all as $v){
			$out[$v['name']] = 1;
		}
		cache_pre('all_modules',$out); 
	}
	function redirect($url){
		return redirect($url);
	}
}