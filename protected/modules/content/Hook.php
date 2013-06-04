<?php 
namespace app\modules\content; 
class Hook
{
	static function run($widget,$action){
		$m = "app\modules\content\widget\\$widget\Hook";
		return $m::$action();
	}
}