<?php 
namespace app\modules\member; 
class Auth
{
	static function check(){
		return static::is_login();
	} 
	static function is_login(){ 
		$info = static::info();
		if($info && $info->id){
			return true;
		}
		return false;
	}
	static function info(){ 
		$value = cookie('user'); 
		$value = (object)json_decode($value); 
		return $value;
	}
	static function logout(){ 
		remove_cookie('user');  
	}
}