<?php namespace app\modules\auth\models; 

 
class UserGroup extends \app\core\ActiveRecord 
{ 
	public static function tableName()
    {
        return 'auth_user_group';
    } 
     
	public function rules()
	{ 
		return array(
			array('user_id, group_id', 'required'),
		);
	}  
    /**
    * 一个用户有多个组
    */
	public function getAccess()
	{
	 	return $this->hasMany('GroupAccess', array('group_id' => 'group_id'));
	}
	/**
	* 保存用户到用户组
	*/
	static function UserGroupSave($user_id,$group){
		static::deleteAll(array('user_id'=>$user_id)); 
		foreach($group as $group_id){
			$model = new self;
			$model->group_id = $group_id;
			$model->user_id = $user_id;
			$model->save();
		}
	}
	
	 
     
}