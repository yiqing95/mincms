<?php namespace app\core\widget;  
/**
*  FormBuilder
* 
* @author Sun < taichiquan@outlook.com >
*/
class Form extends \yii\base\Widget
{ 
	public $model;
	public $fields;  
	public $yaml;
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
	 	));
	}
}