<?php

/**
 * This is the model class for table "member_login_third".
 *
 * The followings are the available columns in table 'member_login_third':
 * @property integer $id
 * @property string $ids
 * @property string $name
 * @property string $image_url
 * @property integer $module_login_oauth_id
 * @property string $access_token
 * @property string $salt
 * @property string $email
 */
class MemberLoginThird extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MemberLoginThird the static model class
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
		return '{{member_login_third}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ids, name, module_login_oauth_id, access_token, salt', 'required'),
			array('module_login_oauth_id', 'numerical', 'integerOnly'=>true),
			array('ids', 'length', 'max'=>200),
			array('name, salt, email', 'length', 'max'=>50),
			array('image_url', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, ids, name, image_url, module_login_oauth_id, access_token, salt, email', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'oauth'=>array(self::BELONGS_TO, 'MemberLoginOauth', 'module_login_oauth_id'), 
			
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
		$criteria->compare('ids',$this->ids,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('image_url',$this->image_url,true);
		$criteria->compare('module_login_oauth_id',$this->module_login_oauth_id);
		$criteria->compare('access_token',$this->access_token,true);
		$criteria->compare('salt',$this->salt,true);
		$criteria->compare('email',$this->email,true);
		if(!is_ajax() && !$_GET['ajax'])
			$criteria->order = "id desc";	
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	function getaccess_token_label(){
		if(is_array(unserialize($this->access_token))){
			foreach(unserialize($this->access_token) as $v){
				$s .= $v."<br>";
			}
			return $s;
		}
		
		return Str_helper::cut($this->access_token,50);
	}
	
	function getimage_url_label(){
		if($this->image_url)
			return CHtml::image($this->image_url,null,array('width'=>30,'height'=>30));
	}
}