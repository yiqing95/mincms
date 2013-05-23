<?php namespace app\widget\redactor;  
/**
* 
* @author Sun < taichiquan@outlook.com >
*/
class Widget extends \yii\base\Widget
{  
 	public $tag;
 	public $options; 
	function run(){  
		 if($this->options)
			$opts = \JS::encode($this->options);
		$base = publish(__DIR__.'/assets');
 		css_file($base.'/redactor.css'); 
 		js_file($base.'/redactor.zh.js'); 
 		if(!$this->tag) return; 
 		js(" 
 			$('".$this->tag."').redactor($opts); 
 		"); 
	}
}