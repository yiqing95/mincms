<?php namespace app\modules\oauth\models; 

 
class OauthConfig extends \app\core\ActiveRecord 
{
 
 
	public static function tableName()
    {
        return 'oauth_config';
    } 
    function scenarios() {
		 return array( 
		 	'all' => array('slug','name','key1','key2'),
		   
		 );
	}
	public function rules()
	{ 
		return array(
			array('slug, name, key1', 'required'), 
			array('slug','unique')
		);
	} 
	function getIds(){
		$img = \yii\helpers\Html::img(base_url().'img/'.$this->slug.'.png',array('width'=>'16px','height'=>'16px'));
		return '<i class="drag"></i>'.\yii\helpers\Html::hiddenInput('ids[]',$this->id).
		\yii\helpers\Html::a($img,url('oauth/'.$this->slug.'/index'),array('target'=>'_blank'));
		
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
	/**
    * for yaml dropDownList
    */
	function value(){
		$dir = __DIR__.'/../controllers';
		$list = scandir($dir);
		$out[""] = __('please select');
		foreach($list as $vo){   
			if($vo !="."&& $vo !=".." && $vo !=".svn" )
			{ 
				$file = $dir.'/'.$vo;
				$d = file_get_contents($file);
				preg_match("/##(.*)/i", $d, $m); 
				$vo = str_replace('Controller.php','',$vo); 
				$vo = strtolower($vo);
				$info = trim($m[1])?:$vo; 
				if(!in_array($vo,array('oauth','site'))){
					$out[$vo] = $info;
				}
			}
		}  
		$all = static::find()->all();
		if($this->isNewRecord && $all ){
			foreach($all as $row){
				unset($out[$row->slug]);
			}
		}
		
		return $out;
	}
	 
	 
}