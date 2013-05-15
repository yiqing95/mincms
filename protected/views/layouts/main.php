<?php
use yii\helpers\Html;
use yii\widgets\Menu;

/**
 * @var $this \yii\base\View
 * @var $content string
 */
$this->registerAssetBundle('bootstrap');
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<title><?php echo Html::encode($this->title); ?></title>
	<?php $this->head(); ?>
</head>
<body>
<div class="navbar navbar-inverse navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container">
      <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="brand" href="/">Yii 2.0 Very Usefull Modules</a>
      <div class="nav-collapse collapse">
    		<?php $this->widget(Menu::className(), array(
				'options' => array('class' => 'nav'),
				'items' => array(
					array('label' => 'Home', 'url' => array('/site/index')),
					array('label' => 'About', 'url' => array('/site/about')),
					array('label' => 'Contact', 'url' => array('/site/contact')),
					Yii::$app->user->isGuest ?
						 "":
						array('label' => 'Logout (' . Yii::$app->user->identity->username .')' , 'url' => array('/auth/open/logout')),
				),
			)); ?>
      </div><!--/.nav-collapse -->
    </div>
  </div>
</div>

 
    
<div class="container">
	<?php $this->beginBody(); ?>
 

	<?php $this->widget('yii\widgets\Breadcrumbs', array(
		'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : array(),
	)); ?>
	<?php echo $content; ?>

	<hr>

	<div class="footer">
		<p>&copy; My Company <?php echo date('Y'); ?></p>
		<p>
			<?php echo Yii::powered(); ?>
			Template by <a href="http://twitter.github.io/bootstrap/">Twitter Bootstrap</a>
		</p>
	</div>
	<?php $this->endBody(); ?>
</div>
<?php $this->widget('yii\debug\Toolbar'); ?>
</body>
</html>
<?php $this->endPage(); ?>
