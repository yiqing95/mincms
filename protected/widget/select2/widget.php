<?php namespace app\widget\select2;  
/**
* 
* @author Sun < mincms@outlook.com >
*/
class Widget extends \yii\base\Widget
{ 
	public $i18n = false;
 	public $tag;
 	public $options;
 
	function run(){ 
		$base = publish(__DIR__.'/assets'); 
		css_file($base.'/select2/select2.css'); 
		js_file($base.'/select2/select2.js'); 
		if($this->i18n===true){
			js("$(function(){
				function format(state) {
				    if (!state.id) return state.text; // optgroup
				    return \"<img class='flag' src='".$base."/img/\" + state.id.toLowerCase() + \".png'/>\" + state.text;
				} 
				$('#i18n').select2({
				    formatResult: format,
				    formatSelection: format,
				    escapeMarkup: function(m) { return m; }
				}).change(function(){  
					$('#i18nForm').submit();
				});
				
				;
			});");
			echo $this->render('@app/widget/select2/views/form');
		}else{
		    js("
		    	$(function(){
		    		$('select').select2();
		    	});
		    
		    ");
	    }
	}
}