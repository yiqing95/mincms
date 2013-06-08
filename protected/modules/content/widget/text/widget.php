<?php namespace app\modules\content\widget\text;  
/**
* 
* @author Sun < mincms@outlook.com >
*/
class Widget extends \app\modules\content\Widget
{  
 	public $tag;
 	public $options; 
	function run(){  
		$name = $this->name;  
 		echo $this->form->field($this->model,$name)->textArea();	 
	}
}