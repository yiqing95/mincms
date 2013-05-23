<?php 
namespace app\modules\auth; 
class Auth
{
	/**
	* where uid in 
	*/
	static function in(){
		 $uid = \Yii::$app->user->identity->id;
		 $self = \Yii::$app->user->identity->yourself;
		 if($self!=1){
		 	return false;
		 }
		 return array($uid);
	}
}