<?php namespace app\core\widget;  
/**
*  render tables
* 
* @author Sun < taichiquan@outlook.com >
*/
class Modal extends \yii\base\Widget
{ 
	 
	function run(){ 
		
		js("
			$(function(){
				$('.mymodal').click(function(){   
					    $('#myModalLabel').html($(this).attr('title'));
					    var url = $(this).attr('rel'); 
					    var options = {   
					    	type: 'post', 
						    url:        url, 
						    success:    function(data) {
						    	 var data = eval('(' + data + ')'); 
						    	 jQuery.each(data.id,function(){ 
						    	 	$('#table-'+this).fadeOut(2000);
						    	 });
						    	 
						    	 $('#update').addClass(data.class).html(data.message).fadeIn().delay(2500).fadeOut();
						         $('.modal').modal('hide');
						         return false;
						    } 
						};  
					    $('#form_modal').ajaxForm(options);
					    $('#form_modal .btn').click(function(){ 
					    	$('#form_modal').submit();
					    });
					    var input = '<input type=\"hidden\" name=\"action\" value=1>';
					    $('.modal-body').html($(this).attr('content')+input);
					
				});
				/*$('.modal').removeData('modal').modal({
				  	show: false, 
				});*/
		 	});
		");  
		 
	 	echo $this->render('@app/core/widget/views/modal',array(
	 	 
	 	));
	}
}