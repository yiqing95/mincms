<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm; 
/**
 * @var yii\base\View $this
 */
 
$this->title = __('oauth');
$this->params['breadcrumbs'][] =  array('label'=>__('oauth'),'url'=>url('oauth/site/index'));  
$this->params['breadcrumbs'][] = __('list'); 
?>
<blockquote>
	<h3>
		<?php echo $this->title; ?> 
	</h3>
</blockquote>
<?php $form = ActiveForm::begin(array(
	'options' => array('class' => 'form-horizontal','id'=>'oauth-sort'),
	'fieldConfig' => array('inputOptions' => array('class' => 'input-xlarge')),
)); ?>
<?php echo app\core\widget\Table::widget(array(
	'models'=>$models,
	'pages'=>$pages,
	'delete'=>false,
	'fields'=>array('ids','name','key1','display_raw')	
));
\app\core\UI::sort('#oauth-sort',url('oauth/site/sort'))
?> 

<?php ActiveForm::end(); ?>
 