<?php 
namespace app\modules\core; 
class Menu
{
	static function add(){
		$menu['system'] = array( 
			'config'=>array('core/config/index'),  
			'modules'=>array('core/modules/index'),
			
	 
		);
		return $menu;
	}
}