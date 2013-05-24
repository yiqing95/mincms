<?php 
namespace app\modules\payment; 
class Menu
{
	static function add(){ 
		$menu['extend'] = array( 
			'payment'=>array('payment/site/index'), 
		 
		); 
		return $menu;
	}
}