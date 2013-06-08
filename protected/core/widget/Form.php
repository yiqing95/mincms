<?php namespace app\core\widget;  
/**
*  FormBuilder
* 
slug: 
   html:dropDownList
   value:php:value  
name:
   html:textInput
key1:
   html:textInput
key2:
   html:textInput
model.php
value:php:value 
function value(){
	$first[0] = __('please select');
	$data = static::find()->all();
	if($data){ 
		$out = \app\core\Arr::model_tree($data);  
		$out = $first+$out; 
	}else{
		$out = $first;
	}
	return $out;
}
* @author Sun < mincms@outlook.com >
*/
class Form extends \yii\base\Widget
{ 
	public $model;
	public $fields;  
	public $yaml;
	public $form=true;
	function run(){ 
		if($this->yaml){
			\Yii::import('@app/vendor/Spyc');
			if(strpos($this->yaml,'@app')!==false){
				$path = str_replace('@app',\Yii::$app->basePath,$this->yaml);
			}else{
				$path = $this->yaml;
			}  
			$yaml = \Spyc::YAMLLoad($path);   
			foreach($yaml as $k=>$v){
				if(strpos($v['value'],'php:')!==false){
					$m = str_replace('php:','',$v['value']);
					$v['value'] = $this->model->$m();
				}
				$data[$k] = $v;
			}
		 
		}
 
	 	echo $this->render('@app/core/widget/views/form',array(
	 		'model'=>$this->model,
	 		'fields'=>$data, 
	 		'show_form'=>$this->form
	 	));
	}
}