<?php 
namespace app\modules\content; 
class Menu
{
	static function add(){
		$menu['content'] = array( 
			'content'=>array('content/site/index'),
			'content type'=>array('content/type/index'),  
			'add'=>array('content/site/create'), 
		);
	 
			
	 
		return $menu;
	}
}