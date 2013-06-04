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
	function getdisplay_raw(){
		if($this->display==1){
			$str = '<i class="icon-ok"></i>';
		}
		else{
			$str = '<i class="icon-remove white" ></i>';
		}
		return "<a href='".url('oauth/site/display',array('id'=>$this->id))."'>".$str."</a>";
	}  
	/**
    * for yaml dropDownList
    */
	function value(){
		$list = scandir(__DIR__.'/../controllers');
		foreach($list as $vo){   
			if($vo !="."&& $vo !=".." && $vo !=".svn" )
			{ 
				$vo = str_replace('Controller.php','',$vo);
				$vo = strtolower($vo);
				if(!in_array($vo,array('oauth','site'))){
					$out[$vo] = $vo;
				}
			}
		}  
		return $out;
	}
	 
	 
}