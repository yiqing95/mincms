<?php $form = \app\core\ActiveForm::begin(array(
	'options' => array('class' => 'form-horizontal','id'=>'form_modal'),
	'fieldConfig' => array('inputOptions' => array('class' => 'input-xlarge')),
)); ?>
<div id="modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header alert alert-error">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="margin-right: 20px;">×</button>
   
	   <h3 id="myModalLabel"></h3> 
	 
  </div>
  <div class="modal-body ">
    
  </div>
  <div class="modal-footer">
    	<?php echo \app\core\Html::button(__('run'), null, null, array('class' => 'btn btn-primary')); ?>
  </div>
</div>

<?php \app\core\ActiveForm::end(); ?>