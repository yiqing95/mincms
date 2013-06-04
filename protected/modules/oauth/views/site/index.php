<?php
use yii\helpers\Html;
/**
 * @var yii\base\View $this
 */
 
$this->title = __('oauth');
$this->params['breadcrumbs'][] =  array('label'=>__('user'),'url'=>url('oauth/site/index'));  
$this->params['breadcrumbs'][] = __('list'); 
?>
<blockquote>
	<h3>
		<?php echo $this->title; ?> 
	</h3>
</blockquote>
<?php echo app\core\widget\Table::widget(array(
	'models'=>$models,
	'pages'=>$pages,
	'fields'=>array('id','slug','name','key1','display_raw')	
));?>

<blockquote>
	<h3>
		<?php echo __('test login');?> 
	</h3>
</blockquote>
<?php echo module_widget('oauth','login');?>