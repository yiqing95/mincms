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
$this->registerMetaTag(array('content'=>'mincms,yii2,yii2 cms,yii2 framework,yii2 framework cms,content manage system,内容管理系统,迷你CMS,迷你内容系统','name'=>'keywords'));
$this->registerMetaTag(array('content'=>'自定义内容管理系统,支持多模块,支付,购物车,第三方登录,权限,会员,多语言,自定义内容等模块','name'=>'descriptian'));

?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<title>MINCMS</title>
	<?php $this->head(); ?>
	<style>
	.margin0{ 
		margin-left: 0px;
	}
    body {
        
      }

      /* Custom container */
      .container-narrow {
        margin: 0 auto;
        max-width: 960px;
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
<div class="container">
<?php $this->beginBody(); ?>
      <div class="masthead" style='position:relative'>
        <ul class="nav nav-pills pull-right" style="margin-right: 117px;">
        <?php $active = \app\core\Menu::active();
    	$menus = array(
    		'site/index'=>'home',
    		'document/site/index'=>'document',
    		'auth/open/login'=>'admin login',
    	);
    	foreach($menus as $k=>$v){
    	?>
          <li <?php if($active && in_array($k,$active)){?> class="active" <?php }?>>
            <a href="<?php echo url($k);?>"><?php echo __($v);?></a>
           </li>
        <?php }?>
        </ul>
        <h3 class="muted">MINCMS</h3>
        <?php if(\app\modules\member\Auth::check()){?>
        	<div class='alert aler-info'>
        		<?php echo __('logined');?>:<?php echo \app\modules\member\Auth::info()->name;?>
        		<a href="<?php echo url('member/logout/index');?>"><?php echo __('logout');?></a>
        	</div>
        <?php }else{?> 
			<?php echo module_widget('oauth','login');?>
        <?php }?>
       <a href="https://github.com/mincms/mincms" target="_blank"> <img style="position: absolute;
top: 0;
right: 0;
z-index: 1000; "src="<?php echo base_url();?>img/fork.png"/></a>
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
	  
    
	<?php $this->endBody(); ?> 
      <div class="footer" style="clear:both;">
        <address><strong>www.mincms.com</strong><br>  
				Email: mincms@outlook.com<br></address>
      </div>

    </div> <!-- /container --> 
    
    	
</body>
</html>
<?php $this->endPage(); ?>
