<?php 
namespace app\modules\svn; 
class Menu
{
	static function add(){ 
		$menu['extend'] = array( 
			'svn'=>array('svn/site/index'), 
		 
		); 
		return $menu;
	}
}