<?php namespace app\modules\auth\models; 

 
class Group extends \app\core\ActiveRecord 
{
 
	public $old_pid;
	public static function tableName()
    {
        return 'auth_groups';
    } 
    function scenarios() {
		 return array( 
		 	'create' => array('slug','name','pid'),
		  	'update' => array('slug','name','pid'),
		 );
	}
	public function rules()
	{ 
		return array(
			array('slug, name, pid', 'required'),
			array('slug,name','unique'),  
			array('slug', 'match','pattern'=>'/^[a-z_]/', 'message'=>__('match')), 
		);
	}   
	/**
	* 一个组里面有多个权限
	*/
	public function getAccess()
	{
	 	return $this->hasMany('GroupAccess', array('group_id' => 'id'));
	}
	 
	 
    /**
    * for yaml dropDownList
    */
	function value(){
		$first[0] = __('please select');
		$data = static::find()->all();
		if($data){ 
			$out = \app\core\Arr::model_tree($data);  
			$out = $first+$out; 
		}else{
			$out = $first;
		}
		return $out;
	}
	/**
	* 删除时，需要删除当前用户组 及 属于当前用户组的记录
	*/
	function getDelete_ids(){
		$data = static::find()->all();
		if($data){
			$out = \app\core\Arr::model_tree($data,$value='name',$id='id',$pid='pid',$this->id); 
		 	$out[$this->id] = $this->id;
		 	foreach($out as $k=>$v){
		 		$in[] = $k;
		 	}
		}else{
			$in[] = $this->id;
		}
		return $in;
	}
	function beforeDelete(){
		parent::beforeDelete();    
	 	static::deleteAll(array('id'=>$this->delete_ids)); 
	 	return true;
	}
	function afterFind(){
		parent::afterFind();
		$this->old_pid = $this->pid;
		return true;
	}
	/**
	* 保存数据前，对pid判断，是否是正确的移动
	* 如移到到自己及自己所属的子分类将提示移动失败
	* pid 值将不会被保存
	*/
	function beforeSave($insert){
		parent::beforeSave($insert);
		if($this->id){ 
			$data = static::find()->all();
			if($data){
				$out = \app\core\Arr::model_tree($data,$value='name',$id='id',$pid='pid',$this->id); 
			 	$out[$this->id] = $this->id;
			}else{
				$out[$this->id] = $this->id;
			}
			if($out[$this->pid]){
				$this->pid = $this->old_pid;
				flash('error',__('try change tree error'));
			}
		}   
	 
		return true;
	}
	/**
	* 显示 向上的树结构
	*/
	function getGroup_tree(){
		if(0 == $this->pid) return __('root');
		$data = static::find()->all();  
		$out = \app\core\Arr::parentTree($data,$this->pid); 
	 	return implode("<br>",$out); 
	}
	
	/**
	* 绑定权限
	*/
	function getBindAccess(){
		return "<a href='".url('auth/auth/index',array('id'=>$this->id))."'>".__('bind access')."</a>";
	}
	 
}