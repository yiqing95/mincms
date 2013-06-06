<?php 
namespace app\modules\host; 
use app\modules\core\Classes;
use app\core\DB;
use app\core\Str;
class Hook
{
	static function controller(){
		$value = Classes::get_config('module_host');
		if($value==1){
			$all = DB::all('host');
			if(!$all) return;
			foreach($all as $v){
				$url = $v['url'];
				$redirect = $v['redirect']; 
				$arr[$url] = $redirect;
			}
			$host = Str::new_replace(host(),array(
				'http://'=>'',
				'https://'=>'',
			)); 
			if($arr[$host]){
				redirect("http://".$arr[$host].$_SERVER['REQUEST_URI']);
			} 
		}
	}
	static function model(){
		
	}
}