<?php namespace app\modules\email\models; 
use yii\helpers\SecurityHelper;
 
class Config extends \app\core\ActiveRecord 
{ 
	public $old;
	public static function tableName()
    {
        return 'email_config';
    }  
    /**
    * $model->scenario = 'all';
    */
    function scenarios() {
		 return array( 
		 	'all' => array('from_email','from_name','from_password','smtp','type','port'),
		   
		 );
	}
	public function rules()
	{ 
		return array(
			array('from_email, from_name, type', 'required'), 
		);
	}   
	function getPass(){
		return SecurityHelper::decrypt(base64_decode($this->old),\Yii::$app->params['SecurityHelper']);
	}
 	/**
 	* 密码为空时，密码字段使用原来的密码
 	*/
    function beforeSave($insert){
    	parent::beforeSave($insert); 
    	if($this->from_password)
    		$this->from_password = base64_encode(SecurityHelper::encrypt($this->from_password,\Yii::$app->params['SecurityHelper']));
     	else
     		$this->from_password = $this->old;
     	return true;
    }
    function afterFind(){
    	parent::afterFind();
    	$this->old = $this->from_password;
    	$this->from_password = "";
    }
 
	 
}