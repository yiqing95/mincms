<?php 
namespace app\modules\menu; 
class Menu
{
	static function add(){ 
		$menu['system'] = array( 
			'menu'=>array('menu/site/index'), 
		 
		); 
		return $menu;
	}
}