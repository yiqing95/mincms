<?php
/**
* 在框架运行前
* cache_pre($name,$value,$expre);
* cache_pre_delete($name);
* @author Sun < mincms@outlook.com >
* @since Yii 2.0
*/
 
class MinCache{
	static $type;
	static $obj;
	static $file;
	static function set($name,$value){
		if(extension_loaded('memcache')){ 
			if(!static::$obj){
				static::$obj = new Memcache;
				static::$obj->connect('127.0.0.1', 11211) or die ("memcache is enable but not work, 127.0.0.1 11211");  
		 		static::$type = 'memcache'; 
	 		}
			if($value){
				static::$obj->set($name, $value ,false ,0 ); 
			}else
				return static::$obj->get($name);
	 	}elseif(extension_loaded('apc')){ 
	 		static::$type = 'apc';
			if($value)
				apc_add($name, $value);
			else
				return apc_fetch($name);
	 	}
	 	else{ 
			static::$file = $file = __DIR__.'/../runtime/'.md5($name).'.php';
			if(!$value){
				if(!file_exists($file)) return false;
				return unserialize(include $file);
			} 
			$str = "<?php return '";
			$str .= serialize($value);
			$str .= "';";
			file_put_contents($file,$str);
		}
	}
	static function delete($name){ 
		if(static::$type == 'memcache'){
			static::$obj->delete($name);
		}elseif(static::$type == 'apc'){
			apc_delete($name);
		}else{
			@unlink($this->file);
		}
	}
}