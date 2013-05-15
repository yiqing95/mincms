<?php
use yii\helpers\Html;
/**
 * @var yii\base\View $this
 */
 
$this->title = __('user');
$this->params['breadcrumbs'][] =  array('label'=>__('user'),'url'=>url('auth/user/index'));  
$this->params['breadcrumbs'][] = __('list'); 
?>
<h1><?php echo Html::encode($this->title); ?></h1>
<?php echo app\core\widget\Table::widget(array(
	'models'=>$models,
	'pages'=>$pages,
	'fields'=>array('id','username','email')	
));?>

