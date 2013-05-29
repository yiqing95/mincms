<?php namespace app\core;  
/** 
*  controller public $theme; change theme
'view' => array(
    'class' => 'yii\base\View',
    'theme' => array(
    	'class' => 'app\core\Theme',  
        'baseUrl' => '@www/themes/'.$theme,
    ),
    'renderers' => array( 
        'twig' => array(
            'class' => 'yii\renderers\TwigViewRenderer',
            'cachePath' => '@wwwroot/assets/runtime/Twig/cache',
        ), 
    ),
),
* @author Sun < taichiquan@outlook.com >
*/
class Theme extends \yii\base\Theme
{ 
	public function init()
	{
		if(property_exists(\Yii::$app->controller,'theme')){ 
			$theme =\Yii::$app->controller->theme;
			$this->pathMap = array(
				'@app/views'=>'@wwwroot/themes/'.$theme
			);
			$this->baseUrl = '@www/themes/'.$theme;
		} 
	 	parent::init();
	  
	}

}