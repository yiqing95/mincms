<?php namespace app\core;  
/**
*  array 
* 
* @author Sun < taichiquan@outlook.com >
* @date 2013
*/
class Arr
{ 
	static $_tree;
	static $_ptree;
	static $_i = 0;
	static $_j = 0;
	static $mark; 
	/**
	* 向下生成tree,返回的是数组 
	*/
	static function tree($data=array(),$value='name',$id='id',$pid='pid',$root=0){   static::$_j = 0;
		foreach($data as $v){  
			if($v->$pid == $root){   
			 	if(static::$mark && in_array($v->pid , static::$mark)){
			 		static::$_j++;
			 	} else{
			 		static::$_j = 0;
			 	}
				for($i=0;$i<static::$_j;$i++){
					$span .= "   ";
				}  
				static::$mark[] = $v->$id;
				static::$_tree[$v->$id] = $span.$v->$value;
				static::$_i++; 
				static::tree($data,$value,$id,$pid,$v->id);  
				
			} 
		} 
	  
		return static::$_tree;
	}
	/**
	* 向上生成tree
	*/
	static function parentTree($data=array(),$parent=null,$root=0,$value='name',$id='id',$pid='pid'){
		static::$_j = 0;
		if(static::$_j == 0){static::$_ptree=array();}
		foreach($data as $v){ 
			$out[$v->$id] = $v->$value; 
		}  
		foreach($data as $v){
			if($v->$id == $parent &&  $v->$pid != $root){  
				static::$_j++;
			 	static::parentTree($data,$v->$pid,$root,$value,$id,$pid); 
				
			} 
		} 
		static::$_ptree[$parent] = $out[$parent];  
		return  static::$_ptree;
	}
}