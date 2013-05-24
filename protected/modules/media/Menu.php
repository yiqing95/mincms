<?php 
namespace app\modules\media; 
class Menu
{
	static function add(){ 
		$menu['simple node'] = array( 
			'post'=>array('media/post/index'), 
			'album'=>array('media/album/index'),  
			'video'=>array('media/video/index'),  
			'news'=>array('media/news/index'),    
		); 
		return $menu;
	}
}