<?php namespace app\core;  
/**
*   
* 
* @author Sun < taichiquan@outlook.com >
*/
class ActiveRecord extends \yii\db\ActiveRecord
{ 
 	public function save($runValidation = true, $attributes = null)
	{
		if ($this->getIsNewRecord()) {
			$r = $this->insert($runValidation, $attributes);
			$this->afterSave(true);
		} else {
			$r = $this->update($runValidation, $attributes) !== false;
			$this->afterSave(false);
		}
		
		return $r;
	}
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