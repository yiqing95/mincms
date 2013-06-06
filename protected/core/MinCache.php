<?php
/**
* 在框架运行前
* cache_pre($name,$value,$expre);
* cache_pre_delete($name);
* @author Sun < taichiquan@outlook.com >
* @since Yii 2.0
*/
 
class MinCache{
	static $type;
	static $obj;
	static $file;
	static $expre;
	static function set($name,$value,$expre=null){
		static::$expre = $expre?:86400*365*365;
		if(extension_loaded('memcache')){ 
	 		$memcache = memcache_connect("127.0.0.1", 11211);   
	 		static::$type = 'memcache';
	 		static::$obj = $memcache;
			if($value)
				$memcache->add($name, $value, false, static::$expre );
			else
				return $memcache->get($name);
	 	}elseif(extension_loaded('apc')){ 
	 		static::$type = 'apc';
			if($value)
				apc_add($name, $value,static::$expre);
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