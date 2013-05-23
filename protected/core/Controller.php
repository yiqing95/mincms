<?php namespace app\core;  
use yii\base\Theme;
/**
*  default controller
* 
* @author Sun < taichiquan@outlook.com >
*/
class Controller extends \yii\web\Controller
{ 
	  
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
		$query = new Query; 
		$query = $query->from('core_modules')
		 	->where(array('active'=>1))
		 	->orderBy('sort desc,id asc');
		$all = $query->createCommand() 
		 	->queryAll();
		foreach($all as $v){
			$out[$v['name']] = 1;
		}
		cache_pre('all_modules',$out); 
	}
}