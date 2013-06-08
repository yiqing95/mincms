<?php 
namespace app\modules\image; 
use app\core\DB; 
use app\core\File;
/**
 *  
 * @author Sun < mincms@outlook.com >
 * @Coprighty  http://mincms.com
 */
class Classes
{
	 static function image($args){
	    $file = $args[1];
	    $option = $args[2]; 
		if(is_array($option)){
			$s = base64_encode(json_encode($option));
		} 
		$name = File::name($file);
		$ext = File::ext($file);
		//如果有upload/ 则替换
		if(substr($name,0,7)=='upload/'){
			$name = substr($name,7);
		} 
		return base_url()."imagine/".$name."=$s{$ext}";
	}
}