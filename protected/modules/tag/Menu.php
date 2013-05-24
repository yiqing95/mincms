<?php 
namespace app\modules\tag; 
class Menu
{
	static function add(){ 
		$menu['system'] = array( 
			'tag'=>array('tag/site/index'), 
		 
		); 
		return $menu;
	}
}