<?php namespace app\modules\content\models; 

use yii\helpers\Html;
class Field extends \app\core\ActiveRecord 
{
 
 
	public static function tableName()
    {
        return 'content_field';
    } 
    function scenarios() {
		 return array( 
		 	'all' => array('slug','name','pid','memo'),
		   
		 );
	}
	public function rules()
	{ 
		return array(
			array('slug, name, pid', 'required'), 
		 	array('slug', 'match','pattern'=>'/^[a-z_]/', 'message'=>__('match')), 
		  	array('slug', 'check'),
		);
	} 
	//检查原密码是否正确
	function check($attribute){
		 
		$model = static::find()->where(array('slug'=>$this->$attribute,'pid'=>$this->pid))->one();
		if($model){
			if(!$this->id){
				$this->addError('slug',__('slug & name is unique')); 
			}else if($this->id !== $model->id){
				$this->addError('slug',__('slug & name is unique')); 
			}
		}
		 
	}
	function getLink(){
		/**
		* 判断是否有下一级的URL
		*/
		if($model = static::find(array('pid'=>$this->id)))
			return Html::a(__('link'),url('content/site/index',array('pid'=>$this->id)));
		return Html::a(__('return back'),url('content/site/index',array('pid'=>$model->pid)));
	}
	
 
	public static function active($query)
    {
    	$pid = (int)$_GET['pid']?:0;
        $query->andWhere('pid = '.$pid);
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
 
	 
}