<?php namespace app\modules\auth\models; 

 
class User extends \app\core\ActiveRecord implements \yii\web\Identity
{
	public $confirm_password;
	public $new_password;
	public $old_password;
	
	public static function tableName()
    {
        return '{{auth_users}}';
    } 
    function scenarios() {
		 return array( 
		 	'create' => array('username','email','password'),
		  	'update' => array('username','email','new_password','new_password','confirm_password'),
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
			$this->password =  $this->hashPassword($this->password); 
		} else{
			//更新密码
			$this->password = $this->hashPassword($this->new_password); 
		}
		return true;
	}
	//return $this->hasOne('Country', array('id' => 'country_id'));
	public function getOrders()
	{
	 	return $this->hasMany('Order', array('customer_id' => 'id'));
	}
	public function events()
    {
        return array(
            'TimeBehavior' => array(
                 'class'=>'app\components\TimeBehavior', 
              )
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
 
	/**
	 * Generates the password hash.
	 * @param string password
	 * @return string hash
	 */
	public function hashPassword($password)
	{
		return crypt($password, $this->generateSalt());
	}
	

	/**
	 * Generates a salt that can be used to generate a password hash.
	 *
	 * The {@link http://php.net/manual/en/function.crypt.php PHP `crypt()` built-in function}
	 * requires, for the Blowfish hash algorithm, a salt string in a specific format:
	 *  - "$2a$"
	 *  - a two digit cost parameter
	 *  - "$"
	 *  - 22 characters from the alphabet "./0-9A-Za-z".
	 *
	 * @param int cost parameter for Blowfish hash algorithm
	 * @return string the salt
	 */
	protected function generateSalt($cost=10)
	{
		if(!is_numeric($cost)||$cost<4||$cost>31){
			throw new CException(Yii::t('Cost parameter must be between 4 and 31.'));
		}
		// Get some pseudo-random data from mt_rand().
		$rand='';
		for($i=0;$i<8;++$i)
			$rand.=pack('S',mt_rand(0,0xffff));
		// Add the microtime for a little more entropy.
		$rand.=microtime();
		// Mix the bits cryptographically.
		$rand=sha1($rand,true);
		// Form the prefix that specifies hash algorithm type and cost parameter.
		$salt='$2a$'.str_pad((int)$cost,2,'0',STR_PAD_RIGHT).'$';
		// Append the random salt string in the required base64 format.
		$salt.=strtr(substr(base64_encode($rand),0,22),array('+'=>'.'));
		return $salt;
	}
 

	public function validatePassword($password)
	{
		return crypt($password,$this->password)===$this->password;
	}
}