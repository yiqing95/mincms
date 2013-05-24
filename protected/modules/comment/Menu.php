<?php 
namespace app\modules\comment; 
class Menu
{
	static function add(){ 
		$menu['extend'] = array( 
			'comment'=>array('comment/site/index'),   
		); 
		return $menu;
	}
}