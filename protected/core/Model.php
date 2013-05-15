<?php namespace app\core;  
/**
*   
* 
* @author Sun < taichiquan@outlook.com >
*/
class Model extends \yii\base\Model
{ 
 
 	/*
 	* 属性自动翻译
 	*
 	*/
	public function attributeLabels()
	{
		$class = new \ReflectionClass($this);
		$names = array();
		foreach ($class->getProperties(\ReflectionProperty::IS_PUBLIC) as $property) {
			$name = $property->getName();
			if (!$property->isStatic()) {
				$names[] = $name;
			}
		}
		$names = array_merge($names,$this->attributes()); 
	 
		foreach($names as $v){
			$out[$v] = __($v);
		} 
	 
		return $out;
	}
}