<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;  
/**
 * @var yii\base\View $this
 */
$this->params['breadcrumbs'][] =  array('label'=>__('content type'),'url'=>url('content/site/index')); 
$this->params['breadcrumbs'][] = $this->title;
?>

<?php echo \app\core\widget\Form::widget(array(
	'model'=>$model,
	'form'=>false,
	'yaml' => "@app/modules/content/forms/".$name.".yaml",
));?>
<div class="control-group">
	<label class="control-label"><?php echo __('form widget');?></label>
	<div class="controls">
		<?php echo Html::dropDownList('widget',$model->widget,$widget);?>
	</div>
</div>
<div class="form-actions">
	<?php echo Html::submitButton(__('save'), null, null, array('class' => 'btn ')); ?>
</div>
<?php ActiveForm::end();?>

