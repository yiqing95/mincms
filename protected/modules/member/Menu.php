<?php 
namespace app\modules\member; 
class Menu
{
	static function add(){ 
		$menu['extend'] = array( 
			'member'=>array('member/site/index'), 
		 
		); 
		return $menu;
	}
}