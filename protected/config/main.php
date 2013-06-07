<?php   
/**
* load modules
* 加载模块
*/
$modules = cache_pre('all_modules'); 
//默认系统模块
$modules['core'] = 1;
$modules['auth'] = 1;
 
$module['debug'] = array(
	 'class' => "yii\debug\Module"
);
if($modules){
	foreach($modules as $k=>$v){
		$module[$k] = array(
			 'class' => 'app\modules\\'.$k.'\Module'
	    );
	}
}
$modules = $module;	  
return array(
	'id' => 'hello',
	'timeZone'=>'Asia/Shanghai',
	'language'=>'zh_cn', 
	'basePath' => dirname(__DIR__),
	'preload' => array('log'), 
	'modules' => $module,
	'components' => array(  
		'cache' => array(
			'class' => 'yii\caching\FileCache', 
		), 
		'assetManager' => array(
			'bundles' => require(__DIR__ . '/assets.php'),
		),
		'log' => array(
			'class' => 'yii\logging\Router',
			'targets' => array(
				/*array(
					'class' => 'yii\logging\FileTarget',
					'levels' => array('error', 'warning'),
				),*/
				array(
					'class' => 'yii\logging\DebugTarget',
				)
			),
		),
	
		/**
		*
		*/
		'db' => array(
			'class' => 'yii\db\Connection',
			'dsn' => 'mysql:host=localhost;dbname=books',
			'username' => 'test',
			'password' => 'test',
			'charset' => 'utf8', 
			'enableSchemaCache'=> !YII_DEBUG,
		),
			
		'urlManager' => array(
			'class' => 'yii\web\UrlManager',
			'enablePrettyUrl'=>true,
			'suffix'=>'.html',
			'rules'=>array(
				
				'post/<id:\d+>/<title:.*?>'=>'post/view',
				'posts/<tag:.*?>'=>'post/index', 
					
				/**
				* default router
				*/
				'admin'=>'core/config/index',
				'image'=>'image/site/index',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),  
		), 
		'user' => array(
			'class' => 'yii\web\User',  
			'autoRenewCookie'=>false,
			'identityCookie'=>array('name' => 'admin_identity', 'httponly' => true),
			'identityClass' => 'app\modules\auth\models\User',
		),
		'view' => array(
            'class' => 'app\core\View',
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
			
	),
	'params' => require(__DIR__ . '/params.php'),
);
