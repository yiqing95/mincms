<?php namespace app\core;  
/** 
 *
* @author Sun < mincms@outlook.com >
* @date 2013
*/
class Str{
	/**
	* 批量替换
	*/
	static function new_replace($body,$replace=array()){ 
		foreach($replace as $k=>$v){
			$body = str_replace($k,$v,$body);
		}
	 	return $body;
	}
	static function value($value){
		if(!static::is_utf8($value)){
			$value = utf8_encode($value);
		}
		return $value;
	}
	/**
	 * 判断字符串是否为utf8编码，
	 * 英文和半角字符返回ture 
	 */
	static function is_utf8($string) {
		return preg_match('%^(?:
		[\x09\x0A\x0D\x20-\x7E] # ASCII
		| [\xC2-\xDF][\x80-\xBF] # non-overlong 2-byte
		| \xE0[\xA0-\xBF][\x80-\xBF] # excluding overlongs
		| [\xE1-\xEC\xEE\xEF][\x80-\xBF]{2} # straight 3-byte
		| \xED[\x80-\x9F][\x80-\xBF] # excluding surrogates
		| \xF0[\x90-\xBF][\x80-\xBF]{2} # planes 1-3
		| [\xF1-\xF3][\x80-\xBF]{3} # planes 4-15
		| \xF4[\x80-\x8F][\x80-\xBF]{2} # plane 16
		)*$%xs', $string);
	}
	 
}