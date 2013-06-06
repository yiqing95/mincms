<?php namespace app\core;  
/**
*   
* 
* @author Sun < taichiquan@outlook.com >
*/
class Load 
{ 
    static $_includes = array();
    /**
    *
    $opts = array(
	  'http'=>array(
	    'method'=>"GET",
	    'header'=>"Accept-language: en\r\n" .
	              "Cookie: foo=bar\r\n"
	  )
	); 
	$opts = array('http' =>
	    array(
	        'method'  => 'POST',
	        'header'  => 'Content-type: application/x-www-form-urlencoded',
	        'content' => $array
	    )
	);  
	Arr::query($array)
    */
	static function url($url,$opts=null){
		if(null==$opts) return file_get_contents($url);
		$context = stream_context_create($opts); 
		return file_get_contents($url, false, $context);
	}
	static function file($file) { 
	    if(is_array($file)){
	    	foreach($file as $f){
	    		static::__include_cache($f);
	    	}
	     	return ;
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