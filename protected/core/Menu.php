<?php namespace app\core;  
/**
*  Menu菜单
* <?php $this->widget(Menu::className(), array(
				'options' => array('class' => 'nav '),
				'activateParents'=>true,
				'submenuTemplate'=>'<ul class="dropdown-menu">{items}</ul>',
				'items' => app\core\Menu::get(),
			)); ?>
* @author Sun < taichiquan@outlook.com >
*/
class Menu
{ 
	static function get(){
		global $modules; 
		foreach($modules as $k=>$v){
			$file = \Yii::$app->basePath."/modules/{$k}/Menu.php";
			if(file_exists($file)){
				$cls = "app\modules\\".$k."\Menu";
				$menus = $cls::add();
				
				foreach($menus as $key=>$val){
					$menu[$key] = array('label' => __($key), 'url' =>'#','itemOptions'=>array(
							'class'=>'dropdown ',  
						),
						'template'=>"<a href=\"{url}\" data-toggle='dropdown' class='dropdown-toggle'>{label}</a>",
					);
					
					foreach($val as $_k=>$_u){
						$menu[$key]['items'][] = array('label' => __($_k), 'url' => ($_u),'options'=>array(
							'class'=>'',
						));
					}
				}
			}
		}
		return $menu;
		 
	}
}