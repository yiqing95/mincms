<?php namespace app\modules\auth\models; 

 
class GroupAccess extends \app\core\ActiveRecord 
{ 
	public static function tableName()
    {
        return 'auth_group_access';
    } 
     
	public function rules()
	{ 
		return array(
			array('group_id, access_id', 'required'), 
		);
	} 
	/**
	* 返回access 里面name
	*/
	function access(){
		$model = Access::find()->all();
		$t = \app\core\Arr::parentTree($model,$this->access_id);
		unset($s);
		foreach($t as $v){
			$s .= $v.".";
		}
		return substr($s,0,-1); 
	}
	/**
	* 保存用户组对应的权限
	*/
	static function saveAccess($group_id,$access){
		static::deleteAll(array('group_id'=>$group_id)); 
		foreach($access as $access_id){
			$model = new self;
			$model->group_id = $group_id;
			$model->access_id = $access_id;
			$model->save();
		}
	} 
  
	 
 
	 
}