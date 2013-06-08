<?php 
namespace app\modules\oauth\controllers; 
use app\core\DB;

class OauthController extends \app\core\FrontController
{
	public $url;
	public $app_key;
	public $app_secret;
	public $oauth_id; 
	public $auth;
	function init(){
		parent::init(); 
		session_start();
	}
	function member_get_oauth_type($name){ 
		$row = DB::one('oauth_config',array(
			'where'=>array('slug'=>$name,'display'=>1)
		));
		return (object)$row;
	}
	function member_get_third_set_user($me,$oauth_id,$token){
		$me['email'] = $me['email']?:'info';
		$uniqid = md5(uniqid(microtime()));
	 
		if(!$me['id']){
			flash('error',__('login failed'));
			$this->redirect(return_url());
		}
		$one = DB::one('oauth_users',array(
			'where'=>array(
				'uid'=>$me['id'],
				'oauth_id'=>$oauth_id
			)
		));
		if($one){
			DB::update('oauth_users',array( 
				'name'=>$me['name'],
				'email'=>$me['email'], 
				'token'=>$token,
				'uuid'=>$uniqid, 
			),"id=:id",array(':id'=>$one['id']));
		}else{
			DB::insert('oauth_users',array(
				'uid'=>$me['id'],
				'name'=>$me['name'],
				'email'=>$me['email'],
				'oauth_id'=>$oauth_id, 
				'token'=>$token,
				'uuid'=>$uniqid, 
			));
		}
		$one = DB::one('oauth_users',array(
			'where'=>array(
				'uuid'=>$uniqid,
				'oauth_id'=>$oauth_id, 
			)
		));
		if($one){
			$value = array(
				'id'=>$one['id'],
				'name'=>$one['name'],
				'email'=>$one['email'],
				'oauth'=>true
			);
			cookie('user',json_encode($value),0);
		}
		
	}
}