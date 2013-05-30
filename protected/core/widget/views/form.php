<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;  
?>
 
<?php $form = ActiveForm::begin(array(
	'options' => array('class' => 'form-horizontal'),
	'fieldConfig' => array('inputOptions' => array('class' => 'input-xlarge')),
)); ?>
	<?php foreach($fields as $k=>$v){ 
	?>
		<?php $out = $form->field($model, $k);  
			  if($v['value'])
			  	echo $out->$v['html']($v['value']);  
			  else
			  	echo $out->$v['html']();  
		?> 
	<?php }?>
	<?php if(true === $form){?>
		<div class="form-actions">
			<?php echo Html::submitButton(__('save'), null, null, array('class' => 'btn ')); ?>
		</div>
	<?php }?>
<?php if(true === $form) ActiveForm::end(); ?>
