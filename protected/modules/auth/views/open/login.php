<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\base\View $this
 * @var yii\widgets\ActiveForm $form
 * @var app\models\LoginForm $model
 */
$this->title = __('login');
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?php echo  $this->title ; ?></h1> 

<?php $form = ActiveForm::begin(array('options' => array('class' => 'form-horizontal'))); ?>
	<?php echo $form->field($model, 'username')->textInput(); ?>
	<?php echo $form->field($model, 'password')->passwordInput(); ?>
	<?php echo $form->field($model, 'rememberMe')->checkbox(); ?>
	<div class="form-actions">
		<?php echo Html::submitButton(__('login'), null, null, array('class' => 'btn btn-primary')); ?>
	</div>
<?php ActiveForm::end(); ?>
