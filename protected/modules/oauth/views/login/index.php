<?php

$this->breadcrumbs=array(
	__('Routers')=>array('admin'),
	__('Create'),
);
$this->menu=array( 
	array('label'=>__('Local Members'), 'url'=>url('member/admin/index')),
 	array('label'=>__('Third Members'), 'url'=>url('member/login/index'),'active'=>true),
 	array('label'=>__('Oauth Setting'), 'url'=>url('member/oauth/index')),
);

$this->widget('application.components.custom_menu',array('menu'=>$this->menu));
?>
<?php


write_script('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('member-login-oauth-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div class="">
<h1> <?php echo __('Manage'); ?></h1> 
<?php echo CHtml::link(__('Advanced').__('Search'),'#',array('class'=>'search-button btn')); ?> 
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('GridView', array(
	'id'=>'member-login-oauth-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		
		'name',
		'email',
		array('name'=>'access_token','value'=>'$data->access_token_label','type'=>'raw'),
		array(
			'name'=>'image_url',
			'type'=>'raw',
			'value'=>'$data->image_url_label' 
		),
		array(
			'name'=>'third login type',
			'type'=>'raw',
			'value'=>'$data->oauth->type' 
		),	
	 
		/*
		'des',
		*/
		array(
			// bootstrap theme
			'class'=>'CButtonColumn',
			'viewButtonLabel'=>false,
			'viewButtonImageUrl'=>false,
			'updateButtonLabel'=>false,
			'updateButtonImageUrl'=>false,
			'deleteButtonLabel'=>false,
			'deleteButtonImageUrl'=>false,
		),
	),
)); ?>
</div>