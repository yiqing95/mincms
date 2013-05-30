<?php namespace app\modules\content\models; 
use app\modules\content\models\Widget;
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
	function create_table($name){
		$sql = "CREATE TABLE IF NOT EXISTS `node_".$name."` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `created` int(11) NOT NULL,
		  `updated` int(11) NOT NULL,
		  `uid` int(11) NOT NULL,
		  `admin` tinyint(1) NOT NULL DEFAULT '1',
		  `display` tinyint(1) NOT NULL DEFAULT '1',
		  `sort` int(11) NOT NULL DEFAULT '0',
		  PRIMARY KEY (`id`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ; 
		CREATE TABLE IF NOT EXISTS `node_".$name."_relate` (
		  `id` int(11) NOT NULL AUTO_INCREMENT,
		  `nid` int(11) NOT NULL,
		  `fid` int(11) NOT NULL,
		  `value` int(11) NOT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
	 
		\Yii::$app->db->createCommand($sql)->execute();
	}
	function getLink(){
		/**
		* 判断是否有下一级的URL
		*/
		if($model = static::find(array('pid'=>$this->id)))
			return Html::a(__('link'),url('content/site/index',array('pid'=>$this->id)));
		return Html::a(__('return back'),url('content/site/index',array('pid'=>$model->pid)));
	}
	
	function afterSave($insert){  
		parent::afterSave($insert);
 		$model = Widget::find(array(
 			'field_id'=>$this->id 
	 	));
	 	if(!$model){
	 		$model = new Widget;
	 	} 
	 	$model->field_id = $this->id ;
	 	$model->name = $_POST['widget'] ;
	 	$model->save();  
	 	 
	 	//create table
	 	$slug = $this->slug; 
	 	if($this->pid!=0){
	 		$m = static::find(array('id'=>$this->pid));
	 		$slug = $m->slug;
	 	}
	 	$this->create_table($slug);
	  	
	}
	function beforeDelete(){
		parent::beforeDelete();
		Widget::find(array('field_id'=>$this->id ))->delete();
	 
	}
	function getwidget(){
		$model = Widget::find(array(
 			'field_id'=>$this->id 
	 	));
		return $model->name;
	}
 	function widgets(){
 		$list = scandir(__DIR__.'/../widget/');
		foreach($list as $vo){   
			if($vo !="."&& $vo !=".." && $vo !=".svn" )
			{ 
				$li[$vo] = $vo;
			}
		}
		return $li;
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
		$data = static::find()->where(array('pid'=>0))->all();
		if($data){ 
			foreach($data as $s){
				$out[$s->id] = $s->name;
			}
			$out = $first+$out; 
		}else{
			$out = $first;
		}
		return $out;
	}  
 
	 
}