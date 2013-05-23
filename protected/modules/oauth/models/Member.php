<?php
/**
 * MinCMS - An open source content manage base on YiiFramework 1.1.x 
 *
 * @package  MinCMS
 * @version  1.0
 * @author   Sun <admin@mincms.com>
 * @Coprighty  http://mincms.com
 */
/**
 * This is the model class for table "users".
 *
 * The followings are the available columns in table 'users':
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property integer $created
 * @property integer $updated
 */
class Member extends ActiveRecord
{
	public $username;
	public $old_password;
	public $password_confirm;
	public $_password;
	public $user_group;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{members}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, email', 'required'),
			array('password', 'required','on'=>'create'),
			
			array('email','email'),
			array('name','unique'),
			array('email','unique'),
			
			array('created, updated', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>10),
			array('email', 'length', 'max'=>50),
			array('password', 'length','min'=>6, 'max'=>88),
			array('password_confirm', 'compare', 'compareAttribute'=>'password', 'on'=>'create,update'),
		 	
		 	array('old_password', 'check',  'on'=>'update'),
		 	
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, email, password, created, updated', 'safe', 'on'=>'search'),
		);
	}
	public function check($attribute,$params)
    {   
     
        if(!$this->validatePassword($this->old_password))
            $this->addError('old_password',__('old_password is not validate'));
    } 

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		 
		 
		);
	}
 

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('created',$this->created);
		$criteria->compare('updated',$this->updated);
		if(!is_ajax() && !$_GET['ajax'])
			$criteria->order = "id desc";	
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	
	public function behaviors(){
		return array(
			'CTimestampBehavior' => array(
				'class' => 'zii.behaviors.CTimestampBehavior',
				'createAttribute' => 'created',
				'updateAttribute' => 'updated',
				'timestampExpression'=>time(),
				'setUpdateOnCreate'=>true,
			)
		);
	}
	
	function beforeSave(){
		parent::beforeSave();
		if($this->isNewRecord == true){
			$this->salt = $this->generateSalt();
		}
		
		if(!$this->errors)
		{
			 if($this->password)
			 	$this->password = $this->hashPassword($this->password,$this->salt);    
			 else
			 	$this->password = $this->_password;
		}  
		
		return true;
		
	}
	
	
  
	/**
	* save user groups
	*/
	function afterSave(){
		parent::afterSave();
	  
		return true;
	}
	
	function afterFind(){
		parent::afterFind();
		$this->_password = $this->password;
	 
	 
		$this->password = null;
		
	}
	
 
	/**
	 * Checks if the given password is correct.
	 * @param string the password to be validated
	 * @return boolean whether the password is valid
	 */
	public function validatePassword($password)
	{ 
		return $this->hashPassword($password,$this->salt)===$this->_password;
	}

	/**
	 * Generates the password hash.
	 * @param string password
	 * @param string salt
	 * @return string hash
	 */
	public function hashPassword($password,$salt)
	{
		return md5($salt.$password);
	}

	/**
	 * Generates a salt that can be used to generate a password hash.
	 * @return string the salt
	 */
	protected function generateSalt()
	{
		return uniqid('',true);
	}
	
	
	function getDisplay_label(){
		if($this->display==1)
			$s =  "<i class='icon-ok'></i>";
		else
			$s =  "<i class='icon-remove'></i>";
		return "<a href='".url('member/admin/active',array('id'=>$this->id))."'  >".$s."</a>"; 
	}
	
	
	


}