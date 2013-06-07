<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm; 
/**
 * @var yii\base\View $this
 */
 
$this->title = __('comment');
$this->params['breadcrumbs'][] =  array('label'=>__('comment'),'url'=>url('comment/site/index'));  
$this->params['breadcrumbs'][] = __('list'); 
?>
<blockquote>
	<h3>
		<?php echo $this->title; ?> 
	</h3>
</blockquote>
 
<?php 
$colunm = array('comment_form');
$flag = false;
if($form){
	$colunm = array('ids','content','display_raw'); 
	$sort = true;
}
?>
<?php if(true===$sort){?>
	<?php $form = ActiveForm::begin(array(
		'options' => array('class' => 'form-horizontal','id'=>'comment-sort'),
		'fieldConfig' => array('inputOptions' => array('class' => 'input-xlarge')),
	)); 
	\app\core\UI::sort('#comment-sort',url('comment/site/sort'));
	?>
<?php }?>
	<?php
	echo app\core\widget\Table::widget(array(
		'models'=>$models,
		'pages'=>$pages, 
		'update'=>false,
		'delete'=>true,
		'create'=>false, 
		'fields'=>$colunm	
	)); 
	?>  
 
<?php if(true===$sort){?>
	<?php ActiveForm::end(); ?>
<?php }?>
 
 