<?php namespace app\core;  
/** 
* 自动加载模块，主要改变 @app/config/main.php 中模块设置
* @author Sun < mincms@outlook.com >
* @date 2013
*/
class Modules{
	/*
	* load modules 
	* 加载模块
	*/
	static function load(){  
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
}