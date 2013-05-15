config main.php
===============
```
'modules' => array( 
	'auth' => array(
		 'class' => 'app\modules\auth\Module', 
    ),
),
'components' => array( 
	'user' => array(
		'class' => 'yii\web\User', 
		'identityClass' => 'app\modules\auth\models\User',
	),
	...
)

```
