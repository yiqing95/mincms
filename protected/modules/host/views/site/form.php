<?php
use yii\helpers\Html;
/**
 * @var yii\base\View $this
 */
$this->params['breadcrumbs'][] =  array('label'=>__('host'),'url'=>url('host/site/index')); 
$this->params['breadcrumbs'][] = $this->title;
?>

<?php echo \app\core\widget\Form::widget(array(
	'model'=>$model,
	'yaml' => "@app/modules/host/forms/host.yaml",
));?>

