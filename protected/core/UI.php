<?php namespace app\core;  
use yii\helpers\Json;
/**
* 
* @author Sun < mincms@outlook.com >
* @date 2013
*/
class UI
{ 
   static function ajax($url,$data=array(),$replace,$js=null,$yii=true){ 
   	   if($data)
   	   		$query = Json::encode($data); 
   	   $script = "
	   	   $.post('".$url."',".$query.",function(data){
	   	   	 $('".$replace."').html(data);
	   	   	 ".$js."
	   	   	 return false;
	   	   });
   	   ";
   	   if($yii===true){
   	   		js($script);
   	   }else{
   	   		return $script;
   	   }
   }
   static function ajaxForm($id,$script=null,$replace='##ajax-form-alert##:'){ 
   	    $update = "ajaxForm".md5(uniqid(microtime())); 
		js("
			$('#".$id."').ajaxForm(function(data) {  
				data = data.substr(strrpos(data,'".$replace."'));
				data = str_replace('".$replace."','',data);
				".$script." 
			}); 
		");	
		js_file('js/php.js');
		js_file('js/jquery.form.js');
	 
   }
   static function sort($id,$url){ 
 	 	 js( "
		 	 //	$( '".$id." tbody td' ).addClass('hand');
				var   node_form_sort;
				var fixHelper = function(e, ui) {
			        ui.children().each(function() {
			            $(this).width($(this).width());                  
			        });
			        return ui;
			    };
		 	 	$( '".$id." tbody' ).sortable({
				helper: fixHelper,
				start:function(e, ui){  
					node_form_sort=$('".$id."').serialize();
		            ui.helper.addClass('highlight');
		            ui.helper.find('td').css({'width':ui.helper.find('td').attr('width')});  
		            return ui;  
		        },  
		        stop:function(e, ui){   
		           ui.item.removeClass('highlight');  
		           if($('".$id."').serialize() == node_form_sort ) return false; 
		           $.post('".$url."',  $('".$id."').serialize(),function(data) {
					 $('#update').html('".__('sort success')."').show().fadeOut(3000);
					});
		           return ui;  
		        }  	
			}).sortable('serialize'); ");
 	 }
}