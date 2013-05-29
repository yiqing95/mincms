<?php namespace app\modules\auth\models; 

use yii\helpers\SecurityHelper;
class User extends \app\core\ActiveRecord implements \yii\web\Identity
{
	public $confirm_password;
	public $new_password;
	public $old_password;
	
	public static function tableName()
    {
        return 'auth_users';
    } 
    function scenarios() {
		 return array( 
		 	'create' => array('username','email','password'),
		  	'update' => array('username','email','old_password','new_password','new_password','confirm_password'),
		 );
	}
	public function rules()
	{ 
		return array(
			array('username, password, email', 'required'),
			array('username,email','unique'),
			array('email','email'),
			array('username, new_password, old_password,confirm_password', 'required','on'=>'update'), 
			array('new_password', 'string', 'min'=>6,'on'=>'update'), 
		 	array('new_password','compare','compareAttribute'=>'confirm_password','operator'=>'==','on'=>'update'),
		 	array('old_password', 'check','on'=>'update'),//更新时添加 检查原密码是否正确
		 		
			array('password', 'string', 'min'=>6), 
		);
	}  
	//检查原密码是否正确
	function check($attribute){
		if(!$this->validatePassword($this->$attribute))
			$this->addError('old_password',__('old password is error')); 
	}
	
	function beforeSave($insert){
		parent::beforeSave($insert); 
		if($this->isNewRecord){
			$this->password =  SecurityHelper::generatePasswordHash($this->password); 
		} else{
			//更新密码 
			$this->password = SecurityHelper::generatePasswordHash($this->new_password);  
		}
		return true;
	}
	/**
	* 生成权限列表
	*/
	static function access($id){
		if(!$id) return false;
		$model = static::find($id);  
    	if($model->groups){
    		//调用 models/Group 
	    	foreach($model->groups as $g){ 
	    		//调用 models/GroupAccess
	    		foreach($g->Access as $gc){  
	    			$list[] = $gc->access();
	    		} 
	    	}
    	}
    	return $list;
	}
 
	public function getGroups()
	{
	 	return $this->hasMany('UserGroup', array('user_id' => 'id'));
	}
	public function behaviors()
	{
	  return array(
	      'timestamp' => array(
	          'class' => 'app\core\TimeBehavior',
	      ),
	  );
	} 
	
	public static function findIdentity($id)
	{
	  return static::find($id);
	}
	public static function findByUsername($username)
	{
		$user = static::find()->where('username=:username', array('username'=>$username))->one();
		if ($user) {
			return new self($user);
		}
		else 
			return null;
	}

	public function getId()
	{
	  return $this->id;
	}

	public function getAuthKey()
	{
	  return $this->authKey;
	}

	public function validateAuthKey($authKey)
	{
	  return $this->authKey === $authKey;
	}
 
 
	public function validatePassword($password)
	{
		return SecurityHelper::validatePassword($password, $this->password);
	}
	 
	/**
	* 绑定用户组
	*/
	function getBindGroup(){
		return "<a href='".url('auth/group/bind',array('id'=>$this->id))."'>".__('bind group')."</a>";
	}
}