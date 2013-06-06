<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;  
use app\core\UI;
use yii\helpers\Json;
use app\modules\member\Auth;
$_top = $formId.'top';
$_bottom = $formId.'bottom';
if($top===true){
	$paginatFormId = $_top; //widget paginate 的class值 需要返回的ajax内容替换
}else{
	$paginatFormId = $_bottom; //widget paginate 的class值 需要返回的ajax内容替换
}

$query = array('slug'=>$slug,'formId'=>$formId); //ajax 传到comment/ajax/index
?> 
<?php 
$script =" 
ajax_pagination();
function ajax_pagination(){
	$( '.pagination a' ).bind( 'click' , function (){  
		$.post($( this ).attr( 'href' ),".Json::encode($query).",function(data){ 
		 	$( '#".$paginatFormId."' ).html(data); 
		 	ajax_pagination();
		}); 
		return  false ; 
	});
}";
UI::ajax(url('comment/ajax/index'),$query,"#".$paginatFormId,$script); 
if($top===true) { 
	echo "<div id='".$paginatFormId."'></div>";
}
?>
<?php if(true === Auth::check()){?>
	<div id="<?php echo $infoMessage;?>" class="alert" style="display:none"></div>
	<?php  
	$form = ActiveForm::begin(array(
		'options' => array('class' => 'form-horizontal','id'=>$formId),
		'fieldConfig' => array('inputOptions' => array('class' => 'input-xlarge')),
	)); ?>
	<?php echo Html::textArea('Comment[body]',null,array('required'=>'required','id'=>'Comment_body'));?>	 
	<p style='margin-top:10px;'>
		<?php echo Html::button(__('comment'), null, null, array('class' => 'btn')); ?>
	</p>

	<?php ActiveForm::end(); 
	UI::ajaxForm($formId,"
		if(data){
			$('#".$infoMessage."').addClass('alert-error')
				.html(data).fadeIn();
			$('#".$formId." .btn').html('".__('comment')."')
					.removeAttr('disabled','disabled');
		
		}else{
			$('#".$infoMessage."').removeClass('alert-error')
					.addClass('alert-success')
					.html('".__('commit success')."')
					.fadeIn();
			$('#".$formId." .btn').html('".__('commented')."');
			".UI::ajax(url('comment/ajax/index'),$query,"#".$paginatFormId,$script,false)."
		}
	 
	");
	js("$('#".$formId." .btn').click(function(){
		$('#".$formId."').submit();
		$(this).html('".__('commenting')."……');
		$(this).attr('disabled','disabled');
		return false;
	});");	
	?>
<?php }else{?>
	<div class='alert alert-waring'><?php echo __('please login first');?></div>
<?php }?>
<?php 
if($top===false) { 
	echo "<div id='".$paginatFormId."'></div>";
}

widget('redactor',array('tag'=>"#Comment_body"));
?>