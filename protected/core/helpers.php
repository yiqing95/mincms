<?php
/**
* Yii 2.0 Helpers
* 
* @author Sun < taichiquan@outlook.com >
* @since Yii 2.0
*/

/**
* create clean url
* @param  string $url 
* @param  array $parmas 
*/
function redirect($url,$parmas=null){ 
	return Yii::$app->response->redirect($url,$parmas);
}
function refresh(){ 
	return Yii::$app->response->refresh();
}
/**
* show widget from @app/widget
*/
function widget($name,$params=null,$file='widget'){
	$cls = "app\widget\\$name\\$file";
	return $cls::widget($params);
}
function core_widget($name,$params=null){
	$cls = "app\core\widget\\$name";
	return $cls::widget($params);
}
/**
* setting language
*/
function language($name='language'){
	if($_GET[$name] || cookie($name) ){
 		if($_GET['language']){
 			cookie($name,$_GET['language']);
 		}
 		return \Yii::$app->language = cookie($name);
 	}
}

/**
* setFlash/getFlash
* @param  string $type 
* @param  string $message 
*/
function flash($type,$message=null){ 
	if($message)
		return Yii::$app->session->setFlash($type,$message);
	return Yii::$app->session->getFlash($type);
}

/**
* Check Flash Message Exists Or Not
* @param  string $type  
*/
function has_flash($type){ 
	return Yii::$app->session->hasFlash($type); 
}
/**
* Assets Manage
*/
function publish($assets){
	$base = \Yii::$app->view->getAssetManager()->publish($assets);
	return $base[1];
}
function css_file($file){
	\Yii::$app->view->registerCssFile($file); 
}
function js_file($file){
	\Yii::$app->view->registerJsFile($file); 
}
function css($css, $options = array(), $key = null){
	\Yii::$app->view->registerCss($css, $options, $key); 
}
function js($css, $options = array(), $key = null){
	\Yii::$app->view->registerJs($css, $options, $key); 
}

/**
* create clean url
* @param  string $url 
* @param  array $parmas 
*/
function url($url,$parmas=null){ 
	if(true===$url || false===$url){
		$url = \Yii::$app->controller->id.'/'.\Yii::$app->controller->action->id;
		$module = \Yii::$app->controller->module->id; 
		if($module && $module!=\Yii::$app->id)
			$url = $module.'/'.$url;  
	}
	return app\core\Html::url($url,$parmas);
}
function url_action($url,$parmas=null){ 
	$url = \Yii::$app->controller->id.'/'.$url;
	$module = \Yii::$app->controller->module->id; 
	if($module && $module!=\Yii::$app->id)
		$url = $module.'/'.$url;  
	return app\core\Html::url($url,$parmas);
}
/**
* i18n translation
* @param  string $str 
* @param  string $file 
*/
function __($message, $params = array(), $language = null){
	return Yii::t(trim($message), $params, $language);
}
/**
* set cookie or get cookie
*/
function cookie($name,$value=null,$expire=null){
	if(!$value){ 
		return \Yii::$app->request->cookies->getValue($name); 
	}
	$options['name'] = $name;
	$options['value'] = $value;
	$options['expire'] = $expire?:time()+86400*365; 
	$cookie = new \yii\web\Cookie($options);
	\Yii::$app->request->cookies->add($cookie); 
}
/**
* print_r
* @param  string/object/array $str  
*/
function dump($str){
	print_r('<pre>');
	print_r($str);
	print_r('</pre>');
} 
/**
* before app start run.
* set cache
*/
function cache_pre($name,$value=null){
	$file = __DIR__.'/../../runtime/'.md5($name).'.php';
	if(!$value){
		return unserialize(include $file);
	} 
	$str = "<?php return '";
	$str .= serialize($value);
	$str .= "';";
	file_put_contents($file,$str);
 
}