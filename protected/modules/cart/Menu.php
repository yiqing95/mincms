<?php 
namespace app\modules\cart; 
class Menu
{
	static function add(){ 
		$menu['extend'] = array( 
			'cart'=>array('cart/site/index'),   
		); 
		return $menu;
	}
}