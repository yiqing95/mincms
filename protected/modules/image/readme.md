### Image size crop etc
- [fuelphp image](http://www.fuelphp.com/docs/classes/image.html) 

how to use

```
$a = array(
	'resize'=>array(300,200),
	'rotate'=>45,
	'border'=>array(10,'red'),
	'rounded'=>array(10, "tl tr"),
);
$file = '1.jpg'; 
$url = image($file,$a);
 

<?php 
use yii\helpers\Html;
echo Html::img($url);
?>

``

dir setting

```
mkdir upload
mkdir imagine
chmod -R 777 upload/
chmod -R 777 imagine/
```

next you can ignore, all config is settings default.

config : add code to <code>.htaccess</code>

```
RewriteEngine on
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php/$1 [L]

RewriteCond %{REQUEST_FILENAME} !\.(jpg|jpeg|png|gif)$
RewriteRule imagine/(.*)\.(jpg|jpeg|png|gif)$ /imagine.html?name=$1&ext=$2 [NC,R,L]  

```