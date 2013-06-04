<?php
use yii\helpers\Html;
/**
 * @var yii\base\View $this
 */
 
$this->title = __('content type');
$this->params['breadcrumbs'][] =  array('label'=>__('content type'),'url'=>url('content/site/index'));  
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
	'fields'=>array('id','slug','name','link')	
));?>

