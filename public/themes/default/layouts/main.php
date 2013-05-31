<?php
use yii\helpers\Html;
use yii\widgets\Menu; 
 
/**
 * @var $this \yii\base\View
 * @var $content string
 */
$this->registerAssetBundle('bootstrap');
//select2
css_file(\Yii::$app->view->theme->baseUrl.'/css/style.css');
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
	<title><?php echo strip_tags(get_config('front_title')); ?></title>
	<?php $this->head(); ?>
	<style>
     /* body {padding-top: 60px;}*/
      .hander{cursor:pointer;}
      .new_error{ 
		background: #FBE6F2;
		border: 1px solid #D893A1;
		color: #333;
		margin: 10px 0 5px 0;
		padding: 10px; 
      }
 
.navbar .nav>.active>a, .navbar .nav>.active>a:hover, .navbar .nav>.active>a:focus {
color: #1abc9c;
background-color:#fff;
box-shadow:none;
-webkit-box-shadow:none;
}
      .form-actions{padding-left: 10px;}
    </style>
</head>
<body>
 
    		<?php /*echo Menu::widget(array(
				'options' => array('class' => 'nav '),
				'activateParents'=>true,
				'submenuTemplate'=>'<ul class="dropdown-menu">{items}</ul>',
				'items' => app\core\Menu::get(),
			)); */?> 
    
<div class="container">
	<div class="row-fluid">
	<div class='nav pull-right' style="margin-top: 10px;">
		<div class="btn-group">
			<span class="btn active"><i class="icon-envelope"></i> liujifa@outlook.com</span>
			<a href="#mySignup" class="btn" data-toggle="modal"><?php echo __('sign up');?></a>
			<a href="#mySignin" class="btn btn-primary" data-toggle="modal"><?php echo __('sign in');?></a>
		</div>
	</div>
	<div class="span12">
			<div class="span4">
					<div class="logo">
						<a href="index.html"><img src="<?php echo theme_url().'css/logo.png';?>" alt="" class="logo"></a>
					</div>
			</div>
			<div class="navbar span8"> 
					<ul class="nav pull-right">
						<?php $menus = array(
								'site/index'=>'home',
								'site/posts'=>'posts',
								'site/videos'=>'videos',
								'site/message'=>'live message',
								'site/us'=>'connect us'
							);
							foreach($menus as $k=>$v){
						?>
						<li <?php if(in_array($k,\app\core\Menu::active())){?> class="active" <?php }?>>
							<a href="<?php echo url($k);?>"><?php echo __($v);?></a>
						</li>
						<?php }?>
						<li>
							<form class="form-search form-inline" style="margin:0;padding-top: 5px;">
								<input type="text" placeholder="<?php echo __('seash words...');?>" class="input-medium search-query" /> 
							</form>
						</li>
						 
					</ul>
						 
				
			</div>
<div style='clear:both;' ></div>
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

	 
	<?php $this->endBody(); ?>
		<hr>
			 <?php echo get_config('front_footer');?>
		</div>
	</div>
</div>
 
</body>
</html>
<?php $this->endPage(); ?>
