<?php 
namespace app\modules\oauth; 
class Menu
{
	static function add(){ 
		$menu['extend'] = array( 
			'oauth'=>array('oauth/site/index'), 
		 
		); 
		return $menu;
	}
}