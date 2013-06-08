<?php 
namespace app\modules\content; 
class Widget extends \yii\base\Widget
{
	public $label;
    public $name;//field name
    public $model;
    public $form;
  	public $value;
  	function init(){
  		parent::init();
  		if(!$this->value)
  			$this->value = $this->model->{$this->name};
  	}
  	 
}