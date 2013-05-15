<?php  global $modules;
$modules['auth'] = 1;
$modules['menu'] = 1;
$modules['core'] = 1; 
$module['debug'] = array(
	 'class' => "yii\debug\Module"
);
foreach($modules as $k=>$v){
	$module[$k] = array(
		 'class' => 'app\modules\\'.$k.'\Module'
    );
}
$modules = $module;	
return array(
	'id' => 'hello',
	'timeZone'=>'Asia/Shanghai',
	'language'=>'zh_cn',
	'runtimePath'=>dirname(__DIR__).'/../runtime',
	'basePath' => dirname(__DIR__),
	'preload' => array('log'), 
	'modules' => $module,
	'components' => array(  
		'cache' => array(
			'class' => 'yii\caching\FileCache',
			'cachePath'=>'@wwwroot/../runtime'
		), 
		'assetManager' => array(
			'bundles' => require(__DIR__ . '/assets.php'),
		),
		'log' => array(
			'class' => 'yii\logging\Router',
			'targets' => array(
				'file' => array(
					'class' => 'yii\logging\FileTarget',
					'levels' => array('error', 'warning'),
				),
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
			'tablePrefix'=>'',
			'enableSchemaCache'=> !YII_DEBUG,
		),
			
		'urlManager' => array(
			'class' => 'yii\web\UrlManager',
			'enablePrettyUrl'=>true,
			'suffix'=>'.html',
			'rules'=>array(
				'auth'=>'auth/site/index',
				'post/<id:\d+>/<title:.*?>'=>'post/view',
				'posts/<tag:.*?>'=>'post/index',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),  
		), 
		'user' => array(
			'class' => 'yii\web\User', 
			'identityClass' => 'app\modules\auth\models\User',
		),
		'view' => array(
            'class' => 'yii\base\View',
            'theme' => array(
            	'class' => 'yii\base\Theme',
		        'pathMap' => array('@app/views' => '@wwwroot/themes/admin'),
		        'baseUrl' => '@www/themes/admin',
		    ),
            'renderers' => array( 
                'twig' => array(
                    'class' => 'yii\renderers\TwigViewRenderer',
                    'cachePath' => '@wwwroot/assets/runtime/Twig/cache',
                ), 
            ),
        ),
			
	),
	'params' => array(
		'adminEmail' => 'admin@example.com',
	),
);
