<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm; 
/**
 * @var yii\base\View $this
 */
 
$this->title = __('host');
$this->params['breadcrumbs'][] =  array('label'=>__('host'),'url'=>url('host/site/index'));  
$this->params['breadcrumbs'][] = __('list'); 
?>
<blockquote>
	<h3>
		<?php echo $this->title; ?> 
	</h3>
</blockquote>
<?php 
$label='disable host';
$cls = 'warning'; 
if($value==1){
$cls = 'success';
$label='enable host';
}?>
<span class="btn btn-<?php echo $cls;?>">
	<?php echo Html::a(__($label),url('host/site/config'));?>
</span>


<?php $form = ActiveForm::begin(array(
	'options' => array('class' => 'form-horizontal','id'=>'host-sort'),
	'fieldConfig' => array('inputOptions' => array('class' => 'input-xlarge')),
)); ?>
<?php echo app\core\widget\Table::widget(array(
	'models'=>$models,
	'pages'=>$pages,
	'title'=>__('revmoe?'),
 	'fields'=>array('ids','redirect')	
));
\app\core\UI::sort('#host-sort',url('host/site/sort'))
?> 

<?php ActiveForm::end(); ?>
 