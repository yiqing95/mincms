<div class="well form-vertical">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'ids'); ?>
		<?php echo $form->textField($model,'ids'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'module_login_oauth_id'); ?>
		<?php 
		$m = MemberLoginOauth::model()->findAll();
		$a  = $this->to_array($m,'id','type');   
		$a[''] = __('All');
		echo $form->dropDownList($model,'module_login_oauth_id',$a); ?>
	</div>

 
	<div class="actions">
          <button type="submit" class="btn btn-info">
          <?php echo __('Search');?>          </button>  
    </div>
	 

<?php $this->endWidget(); ?>

</div><!-- search-form -->