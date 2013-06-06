<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm; 
/**
 * @var yii\base\View $this
 */
 
$this->title = __('comment filter');
$this->params['breadcrumbs'][] =  array('label'=>__('comment filter'),'url'=>url('comment/site/index'));  
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
	'fields'=>array('name','replace')	
));
 
?> 

 
 