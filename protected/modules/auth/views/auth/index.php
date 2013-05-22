<?php
use yii\helpers\Html;
/**
 * @var yii\base\View $this
 */
$this->title = __('bind access');
$this->params['breadcrumbs'][] =  array('label'=>__('user group'),'url'=>url('auth/group/index'));  
$this->params['breadcrumbs'][] = __('bind access'); 
?>
<blockquote>
	<h3>
		<?php echo $model->name;?>  
		<small><?php echo Html::encode($this->title); ?></small>
	</h3>
</blockquote>
<?php $form = app\core\ActiveForm::begin(array(
	'options' => array('class' => 'form-horizontal'),
	'fieldConfig' => array('inputOptions' => array('class' => 'input-xlarge')),
)); ?>
<table class="table table-bordered">
  <thead>
    <tr>
      <th width="100px"><?php echo __('module alias');?></th>
      <th><?php echo __('action name');?></th> 
    </tr>
  </thead>
  <tbody>
    <?php foreach($rows as $k=>$v){ $d = $out[$k];?>
	    <tr>
	      <td><?php echo $d['name'];?></td>
	      <td>
	        <?php if($v){
	        	foreach($v as $_k=>$_v){ $value = $out[$_k]; ?>
	        	<label class="label <?php if($access && in_array($_k,$access)){?> label-info <?php }?>">
	        		<input type='checkbox' name='auth[]' value="<?php echo $_k;?>" 
		        		<?php if($access && in_array($_k,$access)){?>
		        			checked='checked' 
		        		<?php }?>
	        			>
	        		<?php echo $value['name'];?>
	        	</label>
	        <?php }}?> 
	      </td>
	       
	    </tr>
    <?php }?>
  </tbody>
</table>
	<div class="form-actions">
		<?php echo Html::submitButton(__('save access'), null, null, array('class' => 'btn')); ?>
	</div>
<?php app\core\ActiveForm::end(); ?>