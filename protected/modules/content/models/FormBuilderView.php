<?php 
use app\modules\content\models\FormBuilder;
use yii\widgets\ActiveForm;  
use yii\helpers\Html;
$id = 'form'.uniqid();  
$form = ActiveForm::begin(array(
	'options' => array('class' => 'form-horizontal','id'=>$id),
	'fieldConfig' => array('inputOptions' => array('class' => 'input-xlarge')),
));  ?>
<div class="<?php echo $id;?>"></div>

<?php foreach($data as $field=>$value){?>
	<?php 
	/**
	* 后台自动加载插件改变的值
	*/
	$plugins = $value['plugins'];
	if($plugins){
		foreach($plugins as $pk=>$pks){ 
		 	$af = plugin_after($pk,$model->$field); 
			if($af)
				$new = $af; 
		}
	}	
 
	echo module_widget('content',$value['widget'],array(
		'label'=>$value['label'],
		'name'=>$field,
		'value'=>$new,
		'form'=>$form,
		'model'=>$model));?> 
<?php }?>
	
<div class="form-actions">
	<?php echo Html::submitButton(__('save'), null, null, array('class' => 'btn ')); ?>
</div>
</p>
<?php ActiveForm::end();
 
js_file('js/php.js');
js_file('js/jquery.form.js');

$out= "<ul class='alert alert-success'>";
$out.= '<li>'.$message.'</li>';
$out.="</ul>"; 
js("
$('#".$id."').ajaxForm(function(data) { 
	data = data.substr(strrpos(data,'##ajax-form-alert##:'));
	data = str_replace('##ajax-form-alert##:','',data);
	if(data!=1){
		$('.".$id."').html(data);
	}else{
		$('.".$id."').html(\"".$out."\"); 
		".$script."
	}
     
}); 
");	
?>