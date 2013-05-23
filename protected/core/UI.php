<?php namespace app\core;  
/**
* 
* @author Sun < taichiquan@outlook.com >
* @date 2013
*/
class UI
{ 
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
					  if(data==1) noty({text:'".__('admin.sort success')."',type:'success',timeout:1000});
					});
		           return ui;  
		        }  	
			}).sortable('serialize'); ");
 	 }
}