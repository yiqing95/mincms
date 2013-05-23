<blockquote>
	<h3><?php echo __('mail settings');?></h3>
</blockquote>
<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;  
?>
 
<?php $form = ActiveForm::begin(array(
	'options' => array('class' => 'form-horizontal'),
	'fieldConfig' => array('inputOptions' => array('class' => 'input-xlarge')),
)); ?>
 	<?php echo $form->field($model, 'type')->dropDownList(array(1=>'smtp',2=>'send mail',3=>'mail')); ?>
	<?php echo $form->field($model, 'from_email')->textInput(); ?>
	<?php echo $form->field($model, 'from_name')->textInput(); ?>
	<?php echo $form->field($model, 'from_password')->textInput(); ?> 
	<?php echo $form->field($model, 'smtp')->textInput(); ?>
	<?php echo $form->field($model, 'port')->textInput(); ?>
	
 
	<div class="form-actions">
		<?php echo Html::submitButton(__('save'), null, null, array('class' => 'btn ')); ?>
	</div>
<?php ActiveForm::end(); ?>
