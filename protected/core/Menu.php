<?php namespace app\core;  
use app\core\Arr;
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
		/**
		* 控制器中可设置当前启用的URL
		$this->active = array('system','i18n.site.index');
		*/
		if(property_exists(\Yii::$app->controller,'active')){
			$active = \Yii::$app->controller->active;
			if(!is_array($active)) $active = array($active);
			if($active){
				foreach($active as $v){
					$v = str_replace('.','/',$v);
					if(strpos($v,'.')!==false)
						$ac[] = url($v);
					else
						$ac[] = $v;
				}
			}
			$active = $ac;
	 	}
		$modules = cache_pre('all_modules'); 
		if($modules){
			foreach($modules as $k=>$v){
				$file = \Yii::$app->basePath."/modules/{$k}/Menu.php";
				if(file_exists($file)){
					$cls = "app\modules\\".$k."\Menu";
					$menus = $cls::add(); 
					foreach($menus as $key=>$val){
						if(!$menu[$key]){
							unset($actived); 
							if(Arr::array_in_array($key,$active)){
								$actived = 'active';
							}  
							$menu[$key] = array('label' => __($key), 'url' =>'#','itemOptions'=>array(
									'class'=>"dropdown $actived",  
								),
								'template'=>"<a href=\"{url}\" data-toggle='dropdown' class='dropdown-toggle'>{label}</a>",
							);
						}
						foreach($val as $_k=>$_u){
						 	unset($actived); 
							if(Arr::array_in_array($_u,$active)){
								$actived = 'active';
							}  
							$menu[$key]['items'][] = array('label' => __($_k), 'url' => ($_u),'itemOptions'=>array(
								'class'=>$actived,
							));
						}
					}
				}
			}
		}  
	    if(!\Yii::$app->user->isGuest){
		 	 $menu[] = array(
		 	 	'label'=>\Yii::$app->user->identity->username,
		 	 	'url'=>'#',
		 	 	'itemOptions'=>array(
		 	 	 	'class'=>'dropdown'
		 	 	 ),
		 	 	'template'=>"<a href=\"{url}\" data-toggle='dropdown' class='dropdown-toggle'>{label}</a>",
		 	 	'items'=>array(
		 	 	 	array(
		 	 	 		'label'=>__('logout'),
		 	 	 		'url'=>array('auth/open/logout')
		 	 	 	),
		 	 	 )
		 	 );
			 
		 }
	// dump($menu);exit;
		return $menu;
		 
	}
}