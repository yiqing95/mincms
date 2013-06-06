<?php namespace app\modules\host\models; 

 
class Host extends \app\core\ActiveRecord 
{
 
 
	public static function tableName()
    {
        return 'host';
    } 
    function scenarios() {
		 return array( 
		 	'all' => array('redirect','url'),
		   
		 );
	}
	public function rules()
	{ 
		return array(
			array('url, redirect', 'required'), 
			array('url','unique')
		);
	} 
	function getIds(){ 
		return '<i class="drag"></i>'.\yii\helpers\Html::hiddenInput('ids[]',$this->id).$this->url;
		
	}
	function getdisplay_raw(){
		if($this->display==1){
			$str = '<i class="out-right"></i>';
		}
		else{
			$str = '<i class="out-error" ></i>';
		}
		return "<a href='".url('oauth/site/display',array('id'=>$this->id))."'>".$str."</a>";
	}  
 
	 
}