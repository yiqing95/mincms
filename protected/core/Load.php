<?php namespace app\core;  
/**
*   
* 
* @author Sun < taichiquan@outlook.com >
*/
class Load 
{ 
    static $_includes = array();
	
	static function file($file) {
		 
	    if(is_array($file)){
	    	foreach($file as $f){
	    		static::__include_cache($file);
	    	}
	     
	    }
	    return static::__include_cache($file);
	}
	static function __include_cache($file) { 
	    $key = md5($file);
	    if (!isset(static::$_includes[$key])) {
	        if (file_exists($file)) {
	            include $file;
	            static::$_includes[$key] = true;
	        } else {
	            static::$_includes[$key] = false;
	        }
	    }
	    return static::$_includes[$key];
	}
 		 
}