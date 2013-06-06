<?php namespace app\modules\comment\models; 

 
class Comment extends \app\core\ActiveRecord 
{
 
 
	public static function tableName()
    {
        return 'comment';
    } 
    function scenarios() {
		 return array( 
		 	'all' => array('body','slug_id','mid'),
		   
		 );
	}
	
	public function rules()
	{ 
		return array( 
			array('slug_id,body,mid','required')
		);
	} 
	public function getBody()
	{
	 	return $this->hasOne('Body', array('id' => 'body_id'));
	}
	function getContent(){
		$m = $this->body;
		return $m->body;
	}
	function getdisplay_raw(){
		if($this->display==1){
			$str = '<i class="out-right"></i>';
		}
		else{
			$str = '<i class="out-error" ></i>';
		}
		return "<a href='".url('comment/site/display',array('id'=>$this->id,'form'=>$_GET['form']))."'>".$str."</a>";
	}  
	function getIds(){ 	 
		return '<i class="drag"></i>'.\yii\helpers\Html::hiddenInput('ids[]',$this->id).$this->id;
		
	}
	 
	 
	 
}