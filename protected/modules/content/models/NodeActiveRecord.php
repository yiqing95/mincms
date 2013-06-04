<?php namespace app\modules\content\models; 
use yii\validators\RequiredValidator;
use yii\validators\Validator;
/**
 * - `boolean`: [[BooleanValidator]]
 * - `captcha`: [[CaptchaValidator]]
 * - `compare`: [[CompareValidator]]
 * - `date`: [[DateValidator]]
 * - `default`: [[DefaultValueValidator]]
 * - `double`: [[NumberValidator]]
 * - `email`: [[EmailValidator]]
 * - `exist`: [[ExistValidator]]
 * - `file`: [[FileValidator]]
 * - `filter`: [[FilterValidator]]
 * - `in`: [[RangeValidator]]
 * - `integer`: [[NumberValidator]]
 * - `match`: [[RegularExpressionValidator]]
 * - `required`: [[RequiredValidator]]
 * - `string`: [[StringValidator]]
 * - `unique`: [[UniqueValidator]]
 * - `url`: [[UrlValidator]]
 
* @author Sun < taichiquan@outlook.com >
*/
class NodeActiveRecord extends \yii\base\Model  
{ 
 	public $rules; 
 	static $table;
 	public static function tableName()
    {
        return static::$table;
    } 
  	/*unction scenarios() {
		 return array( 
		 	'all' => array('slug','name','pid','memo'), 
		 );
	}*/
  	public function rules()
    {
        return $this->rules;
    }
	public function __get($name) {  
		if(!isset($this->$name)) { 
			return false;
		} 
		parent::__get($name); 
	}

	public function __set($name,$value)
	{
		$this->$name = $value;
	}

}