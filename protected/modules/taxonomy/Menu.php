<?php 
namespace app\modules\taxonomy; 
class Menu
{
	static function add(){ 
		$menu['system'] = array( 
			'taxonomy'=>array('taxonomy/site/index'), 
		 
		); 
		return $menu;
	}
}