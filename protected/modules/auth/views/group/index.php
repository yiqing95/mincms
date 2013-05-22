<?php
use yii\helpers\Html;
/**
 * @var yii\base\View $this
 */
$this->title = __('user group');
$this->params['breadcrumbs'][] =  array('label'=>__('user group'),'url'=>url('auth/group/index'));  
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
	'title'=>'remove group',
	'content'=>'do you want to do this',
	'fields'=>array('slug','name','group_tree','bindaccess')	,
));?>

