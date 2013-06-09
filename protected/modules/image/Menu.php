<?php 
namespace app\modules\image; 
class Menu
{
	static function add(){ 
		$menu['system'] = array( 
			'image cache'=>array('image/admin/index'),   
		); 
		return $menu;
	}
}