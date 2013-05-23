<blockquote>
	<?php echo __('test send mail');?>
</blockquote> 
<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;  

?>
 
<?php $form = ActiveForm::begin(array(
	'options' => array('class' => 'form-horizontal'),
	'fieldConfig' => array('inputOptions' => array('class' => 'input-xlarge')),
)); ?>
 	<?php echo $form->field($model, 'to_email')->textInput(); ?>
	<?php echo $form->field($model, 'to_name')->textInput(); ?>
	<?php echo $form->field($model, 'title')->textInput(); ?> 
	<?php echo $form->field($model, 'body')->textArea(); ?>
	<?php echo $form->field($model, 'attach')->textInput(); ?>
	
 
	<div class="form-actions">
		<?php echo Html::submitButton(__('send mail'), null, null, array('class' => 'btn ')); ?>
	</div>
<?php ActiveForm::end(); 
		
widget('redactor',array(
	'tag'=>'#send-body'
));		
?>
