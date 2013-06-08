<?php
use yii\helpers\Html;
/**
 * @var yii\base\View $this
 */
$this->params['breadcrumbs'][] =  array('label'=>__('oauth'),'url'=>url('oauth/site/index')); 
$this->params['breadcrumbs'][] = $this->title;
?>

<?php echo \app\core\widget\Form::widget(array(
	'model'=>$model,
	'yaml' => "@app/modules/oauth/forms/".$name.".yaml",
));?>

