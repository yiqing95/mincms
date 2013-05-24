<?php 
namespace app\modules\email; 
class Menu
{
	static function add(){
		$menu['system'] = array( 
			'mail'=>array('email/config/index'),
		);
		$menu['extend'] = array( 
			'email templates'=>array('email/template/index'),  
			'test send mail'=>array('email/site/index'), 
		); 
		return $menu;
	}
}