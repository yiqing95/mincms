<?php 
namespace app\modules\host; 
class Menu
{
	static function add(){ 
		$menu['system'] = array( 
			'host'=>array('host/site/index'),   
		); 
		return $menu;
	}
}