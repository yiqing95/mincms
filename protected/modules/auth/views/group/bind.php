<?php
use yii\helpers\Html;
/**
 * @var yii\base\View $this
 */
$this->title = __('bind group');
$this->params['breadcrumbs'][] =  array('label'=>__('user group'),'url'=>url('auth/group/index'));  
$this->params['breadcrumbs'][] = __('save user group'); 
?>
<blockquote>
	<h3>
		<?php echo $model->username;?>  
		<small><?php echo Html::encode($this->title); ?></small>
	</h3>
</blockquote>
<?php $form = app\core\ActiveForm::begin(array(
	'options' => array('class' => 'form-horizontal'),
	'fieldConfig' => array('inputOptions' => array('class' => 'input-xlarge')),
)); ?>
 
<?php echo Html::dropDownList('group[]',$groups,$rows,array('multiple'=>'multiple','style'=>'width:300px;'));?>
 
	<div class="form-actions">
		<?php echo Html::submitButton(__('save user group'), null, null, array('class' => 'btn')); ?>
	</div>
<?php app\core\ActiveForm::end(); ?>