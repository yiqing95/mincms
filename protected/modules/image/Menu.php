<?php 
namespace app\modules\image; 
class Menu
{
	static function add(){ 
		$menu['system'] = array( 
			'image'=>array('image/site/index'),   
		); 
		return $menu;
	}
}