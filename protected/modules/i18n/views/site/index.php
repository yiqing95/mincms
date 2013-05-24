<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;  
?>
<blockquote>
	<h3><?php echo __('translate message');?></h3>
</blockquote>
<hr>
<div class="row-fluid">
<div class='span4'>
<?php foreach($dirs as $d){?>	
<blockquote>
	<h6><?php echo $d;?></h6>
	<?php $list = $dir[$d];
	if($list){
		foreach($list as $li){?>
			<small><a href="<?php echo url('i18n/site/index',array(
				'id'=>$li,'name'=>$d
				));?>"><?php echo $li;?></a></small>
	<?php }}?>
</blockquote>
<?php }?>
</div>
 
<?php if($id){?>
<div class='span8'>
	<?php $form = ActiveForm::begin(array(
		'options' => array('class' => 'form-horizontal'),
		'fieldConfig' => array('inputOptions' => array('class' => 'input-xlarge')),
	)); ?>
	<blockquote>
		<h6><?php echo __('translate file');?></h6>
		<small><?php echo $name.' / '.$id;?> </small>
		<?php echo Html::dropDownList('lan',$name,$dirs);?>
		<?php echo Html::submitButton(__('save'), null, null, array('class' => 'btn ','style'=>'
		float: right;
width: 100px;
height: 90px;
position: relative;
top: -52px;
	')); ?>
	</blockquote> 
	 
	
 
	<i class="icon-plus hander add"></i>
	 
	<?php if($content){?>
		<?php foreach($content as $k=>$v){ if(!$k) continue;?>
			<p class='well'> <i class="icon-trash hander remove" style="float:right;"></i>
				<input name="key[]" class="input-large" value="<?php echo $k;?>" style='width:80%;margin-bottom:5px;'> 
				<textarea name="value[]" style='width:80%'> <?php echo $v;?> </textarea>
			</p>
		<?php }?>
	<?php }?>
	
	<?php ActiveForm::end(); ?>
</div>
<?php }?>
</div>
<?php
js("
$('.add').click(function(){
	$('p:first').before('<p class=\'well\'>'+$('p:first').html()+'</p>');
	$('p:first').find('input').val('');
	$('p:first').find('textarea').val('');
	module_i18n_remove(); 
});
module_i18n_remove();
function module_i18n_remove(){
	$('.remove').click(function(){
		$(this).parent('p').remove();
	});
}
");
?>