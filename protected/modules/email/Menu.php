<?php 
namespace app\modules\email; 
class Menu
{
	static function add(){
		$menu['email'] = array(  
			'settings'=>array('email/config/index'),  
		 	'templates'=>array('email/template/index'),  
			'test send mail'=>array('email/site/index'),  
	 
		);
		return $menu;
	}
}