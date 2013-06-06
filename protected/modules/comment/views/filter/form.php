<?php
use yii\helpers\Html;
/**
 * @var yii\base\View $this
 */
$this->params['breadcrumbs'][] =  array('label'=>__('comment filter'),'url'=>url('comment/site/index')); 
$this->params['breadcrumbs'][] = $this->title;
?>

<?php echo \app\core\widget\Form::widget(array(
	'model'=>$model,
	'yaml' => "@app/modules/comment/forms/".$name.".yaml",
));?>

