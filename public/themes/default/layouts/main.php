<?php
use yii\helpers\Html;
use yii\widgets\Menu; 
 
/**
 * @var $this \yii\base\View
 * @var $content string
 */
$this->registerAssetBundle('bootstrap');
 
widget('select2');
widget('prettify',array('theme'=>'1'));
js("$(function(){
	$('.flash-message').delay(2500).fadeOut();
});");
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<title>MINCMS</title>
	<?php $this->head(); ?>
	<style>
    body {
        padding-top: 20px;
        padding-bottom: 40px;
      }

      /* Custom container */
      .container-narrow {
        margin: 0 auto;
        max-width: 700px;
      }
      .container-narrow > hr {
        margin: 30px 0;
      }

      /* Main marketing message and sign up button */
      .jumbotron {
        margin: 60px 0;
        text-align: center;
      }
      .jumbotron h1 {
        font-size: 72px;
        line-height: 1;
      }
      .jumbotron .btn {
        font-size: 21px;
        padding: 14px 24px;
      }

      /* Supporting marketing content */
      .marketing {
        margin: 60px 0;
      }
      .marketing p + h4 {
        margin-top: 28px;
      }
    </style>
</head>
<body  >
<div class="container-narrow">
<?php $this->beginBody(); ?>
      <div class="masthead">
        <ul class="nav nav-pills pull-right">
          <li class="active"><a href="<?php echo url('site/index');?>">Home</a></li>
          <li><a href="#">MINCMS ON LINE</a></li>
          <li><a href="<?php echo url('auth/open/login');?>">Login Admin</a></li>
        </ul>
        <h3 class="muted">MINCMS</h3>
      </div>

      <hr> 
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
 
	<?php echo $content; ?> 
      <hr>
	<?php $this->endBody(); ?>
      <div class="footer">
        <address><strong>www.mincms.com</strong><br>  
				Email: taichiquan@outlook.com<br></address>
      </div>

    </div> <!-- /container --> 
</body>
</html>
<?php $this->endPage(); ?>
