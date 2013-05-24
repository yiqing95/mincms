<?php
/**
 * @var yii\base\View $this
 */
 
$this->title = 'Welcome';

$m = array(
	'auth'=>array(
		'label'=>'Auth System',
		'des'=>"Auth Control Your Database Table's Fields",
		'url'=>'auth/site/index',
		'progress'=>100
	), 
	'payment'=>array(
		'label'=>'Payment System',
		'des'=>"Payment Drives like alipay, paypal,bankwire ETC",
		'url'=>'payment/site/index',
		'progress'=>1
	),
	'file'=>array(
		'label'=>'File System',
		'des'=>"support upload files and manage files,ajax upload",
		'url'=>'file/site/index',
		'progress'=>1
	),
	'member'=>array(
		'label'=>'Member System',
		'des'=>"Member Login/Register/Change Password/Rest Password Use Email",
		'url'=>'oauth/site/index',
		'progress'=>1
	),
	'oauth'=>array(
		'label'=>'Oauth System',
		'des'=>"Third Login Support Weibo.com<br> QQ Gmail ETC",
		'url'=>'oauth/site/index',
		'progress'=>1
	),
	
	'media'=>array(
		'label'=>'Simple Media System',
		'des'=>"Articles  Videos  Albums support <br>easy create articles",
		'url'=>'media/site/index',
		'progress'=>1
	),
	'cart'=>array(
		'label'=>'Cart System ',
		'des'=>"Cart for members, should be install member module",
		'url'=>'cart/site/index',
		'progress'=>1
	),
	'comment'=>array(
		'label'=>'Comment System ',
		'des'=>"Comment very module ,if module support commnet",
		'url'=>'comment/site/index',
		'progress'=>1
	),
	'tag'=>array(
		'label'=>'TAG System ',
		'des'=>"tags in very module ,if module support tag",
		'url'=>'tag/site/index',
		'progress'=>1
	),
	'taxonomy'=>array(
		'label'=>'Taxonomy System ',
		'des'=>"taxonomy in very module ,if module support taxonomy",
		'url'=>'taxonomy/site/index',
		'progress'=>1
	),
	'email'=>array(
		'label'=>'Email System ',
		'des'=>"send email to anyone",
		'url'=>'email/site/index',
		'progress'=>70
	),
	'content'=>array(
		'label'=>'Content System ',
		'des'=>"custome content manage system",
		'url'=>'content/site/index',
		'progress'=>1
	),
	'i18n'=>array(
		'label'=>'I18n System',
		'des'=>"Translation message",
		'url'=>'i18n/site/index',
		'progress'=>70
	),			
);
?>
 
<h2><?php echo __('Modules');?></h2>
 

<!-- Example row of columns -->
<div class="row-fluid">
	<?php $str="";$i=1;foreach($m as $k=>$v){ ?>
	<div class="span4 well">
		<h3> <?php echo __($v['label']);?> </h3> 
		<p> 
			<?php echo __($v['des']);?> 
			<div class="progress">
			  <div class="bar" style="width: <?php echo $v['progress'];?>%;"></div>
			</div>
		</p> 
		<p><a class="btn" href="<?php echo url($v['url']);?>"><?php echo __('view');?></a></p>
	</div>
 	<?php if($i%3==0) echo "<div class='row-fluid'>"; $str .= "</div>";$i++;} echo $str;?>
	 
</div>

