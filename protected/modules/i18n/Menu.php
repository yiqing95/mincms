<?php 
namespace app\modules\i18n; 
class Menu
{
	static function add(){
		$menu['system'] = array( 
			'i18n'=>array('i18n/site/index'),  
		);
		
		$menu['extend'] = array( 
			'i18n database'=>array('i18n/database/index'),  
		);
		return $menu;
	}
}