<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;  	
$form = ActiveForm::begin(array(
	'options' => array('class' => 'form-horizontal'),
	'fieldConfig' => array('inputOptions' => array('class' => 'input-xlarge')),
)); ?>

<?php echo  $form->field($model, 'slug')->textInput();  ?>
<?php echo  $form->field($model, 'type')->dropDownList($image);  ?>
<div class='resize well control-group ' style='margin-left:120px;width:300px;'>
	<p><?php echo __('resize');?></p>
	<p><?php echo __('width');?>:<input name="memo['resize'][]" class='input-xlarge'></p>
	<p><?php echo __('height');?>:<input name="memo['resize'][]"  class='input-xlarge'></p>
	<p><?php echo __('resize');?>:<input name="memo['resize'][]" class='input-xlarge' ></p>
	<p><?php echo __('resize');?>:<input name="memo['resize'][]" class='input-xlarge'></p>
</div>
<?php echo  $form->field($model, 'description')->textArea();  ?>

<div class="form-actions">
	<?php echo Html::submitButton(__('save'), null, null, array('class' => 'btn ')); ?>
</div>
 
<?php ActiveForm::end(); ?>