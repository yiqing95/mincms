<?php 
namespace app\modules\content; 
class Menu
{
	static function add(){
		$menu['content'] = array( 
			'content'=>array('content/node/index'),
			'content type'=>array('content/site/index'),  
			'add'=>array('content/node/create'), 
		);
	 
			
	 
		return $menu;
	}
}