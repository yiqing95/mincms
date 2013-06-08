<?php namespace app\modules\oauth\widget;  
use app\core\DB;
/**
* 
* @author Sun < mincms@outlook.com >
*/
class Login extends \yii\base\Widget
{ 
 	public $img = true;
	function run(){ 
		$rows = DB::all('oauth_config',array('orderBy'=>'sort desc,id desc','where'=>array('display'=>1)));
		echo $this->render('@app/modules/oauth/widget/views/login',array('rows'=>$rows,'img'=>$this->img));
	 
	}
}