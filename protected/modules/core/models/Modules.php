<?php namespace app\modules\core\models; 

 
class Modules extends \app\core\ActiveRecord 
{
 
	public $old_pid;
	public static function tableName()
    {
        return 'core_modules';
    } 
    
	public function rules()
	{ 
		return array(
			array('name', 'required'), 
		);
	}   
	function getIds(){
	    return "<input type='hidden' class='ids' name='ids[]' value='".$this->id."'>".$this->name;
	}
 
	 
}