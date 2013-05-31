<?php 
namespace app\modules\multisite; 
class Menu
{
	static function add(){ 
		$menu['extend'] = array( 
			'multisite'=>array('multisite/site/index'), 
		 
		); 
		return $menu;
	}
}