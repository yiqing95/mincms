### Image size crop etc
- [imagine](http://imagine.readthedocs.org/en/latest/)
- [Imagine on GIT](https://github.com/avalanche123/Imagine)

how to use

```
$a = array(
	'resize'=>array(300,200)
);
$file = '2013/05/29/2.jpg'; 
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
.htaccess
RewriteEngine on
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ index.php/$1 [L]

RewriteCond %{REQUEST_FILENAME} !\.(jpg|jpeg|png|gif)$
RewriteRule imagine/(.*)\.(jpg|jpeg|png|gif)$ /imagine/$1/$2 [NC,R,L]  


compose.json 

"imagine/Imagine":"dev-master"

```