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
		hook('controller'); 
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
	 	$dir = base_path().'modules/';
		foreach($all as $v){
			$name = $v['name'];
			$out[$name] = 1;
			//加载Hook.php
			$h = $dir.$name.'/Hook.php';
			if(file_exists($h)){
		 		$reflection = new \ReflectionClass("\app\modules\\$name\Hook"); 
				$methods = $reflection->getMethods(); 
				foreach($methods as $m){
					$action[$m->name][] = $name;
				} 
			} 
		} 
		cache_pre('all_modules',$out); 
		cache_pre('hooks',$action); 
		
	}
	function redirect($url){
		return redirect($url);
	}
}