<?php
use yii\helpers\Html;
use yii\widgets\Menu; 
 
/**
 * @var $this \yii\base\View
 * @var $content string
 */
$this->registerAssetBundle('bootstrap');
//select2

widget('select2');
js("$(function(){
	$('.flash-message').delay(2500).fadeOut();
});");
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<title><?php echo __('backend admin'); ?></title>
	<?php $this->head(); 
	css_file('css/admin.css');
	?>
 
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
      <a class="brand" href="<?php echo url('site/index');?>"><?php echo __('backend admin');?></a>
      <div class="nav-collapse collapse"> 
    		<?php echo Menu::widget(array(
				'options' => array('class' => 'nav '),
				'activateParents'=>true,
				'submenuTemplate'=>'<ul class="dropdown-menu">{items}</ul>',
				'items' => app\core\Menu::get(),
			)); ?>
			
		 		
			<div style="padding-top: 6px;">	
				<?php echo widget('select2',array('i18n'=>true)); ?>
			</div>
      </div><!--/.nav-collapse -->
      
    </div>
  </div>
</div>

 
    
<div class="container" style="margin-top: 60px;">
	<?php $this->beginBody(); ?>
  
	<?php echo \yii\widgets\Breadcrumbs::widget(array(
		'homeLink'=>array('label'=>__('home'),'url'=>array('site/index')),
		'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : array(),
	)); ?>
	<?php 
		//显示flash message
		foreach(array('success','error') as $type){
		if(has_flash($type)){?>
		<div class="alert alert-<?php echo $type;?> flash-message"><?php echo flash($type);?></div>
	<?php }}?>
	<div id='update' class='alert alert-success' style='display:none'></div>		
	<?php echo $content; ?>

	

	<div class="footer">
		<p>&copy; mincms.com <?php echo date('Y'); ?></p>
		<p>
			Yii <?php echo Yii::getVersion(); ?> 
		</p>
		<p>
			Template by <a href="http://twitter.github.io/bootstrap/">Twitter Bootstrap</a>
		</p>
	</div>
	<?php $this->endBody(); ?>
</div>
 
</body>
</html>
<?php $this->endPage(); ?>
