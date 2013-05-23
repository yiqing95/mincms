<?php

/**
 * This is the model class for table "member_login_oauth".
 *
 * The followings are the available columns in table 'member_login_oauth':
 * @property integer $id
 * @property string $app_key
 * @property string $app_secret
 * @property string $type
 * @property integer $active
 * @property integer $sort
 * @property string $des
 */
class MemberLoginOauth extends ActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return MemberLoginOauth the static model class
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
		return '{{member_login_oauth}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('app_key, app_secret, type, des', 'required'),
			array('active, sort', 'numerical', 'integerOnly'=>true),
			array('app_key, app_secret', 'length', 'max'=>100),
			array('type', 'length', 'max'=>10),
			array('des', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, app_key, app_secret, type, active, sort, des', 'safe', 'on'=>'search'),
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
		);
	}

	function getActive_label(){
		if($this->active==1)
			$s =  "<i class='icon-ok'></i>";
		else
			$s =  "<i class='icon-remove'></i>";
		return "<a href='".url('member/oauth/active',array('id'=>$this->id))."'>".$s."</a>"; 
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
		$criteria->compare('app_key',$this->app_key,true);
		$criteria->compare('app_secret',$this->app_secret,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('active',$this->active);
		$criteria->compare('sort',$this->sort);
		$criteria->compare('des',$this->des,true);
		if(!is_ajax() && !$_GET['ajax'])
			$criteria->order = "sort desc,id asc";	
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	function getIds(){
	    return "<input type='hidden' class='ids' name='ids[]' value='".$this->id."'>".$this->id;
	}
}