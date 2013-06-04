<?php namespace app\modules\oauth\controllers; 
use app\modules\oauth\libraries\oauth2\OAuth2;
use app\modules\oauth\libraries\oauth2\Token;
/**
 *  
 * @author Sun < taichiquan@outlook.com >
 * @Coprighty  http://mincms.com
 */
class InstagramController extends OauthController
{
	public $url;
	public $app_key;
	public $app_secret;
	public $oauth_id;
	public $type = 'instagram';
	public $auth;
 	/**
 	* load some required files
 	*/
	function init(){
		parent::init(); 
	 	$row = $this->member_get_oauth_type($this->type);
		if(!$row->id){
			exit('access deny');
		} 
		$this->oauth_id = $row->id; 
		$this->app_key = $row->key1;
		$this->app_secret = $row->key2;
		$this->url = host().url('oauth/'.$this->type.'/return'); 
		
        session_start(); 
         
		
	}
 	public function actionIndex()
	{
	 	$code_url = "https://api.instagram.com/oauth/authorize/?client_id=".$this->app_key."&redirect_uri=".urlencode($this->url)."&response_type=code";
 		header("location:$code_url"); 
 		exit;
	}
	function actionReturn(){
		$this->auth = OAuth2::provider($this->type, array(
	    	'id' =>$this->app_key, 
	        'secret' => $this->app_secret, 
		));     
		$params['redirect_uri'] = $this->url;
		$params['grant_type'] = 'authorization_code';
		$o = $this->auth->access($_GET['code'],$params);
		$_GET['access_token'] = $o->access_token;
		 dump($o);exit;
		$info = $o->user;
	 	$this->save_login($info);
	  
	}
	
	protected function save_login(){
		$access_token = $_GET['access_token'];
		if ($_GET['access_token']){
			try
	        {          
 				$uid = $info['uid']; 
 				$me['id'] = $uid;
 				$me['name'] = $info['username']; 
 				$me['email']  = $info['emial'];  
				 
				$r = $this->member_get_third_set_user($me,$this->oauth_id,$access_token);   
				
		 	 	flash('success',__('login success'));
				$this->redirect(return_url());
				
			} catch (OAuthException $e) {
				flash('error',__('login error'));
				$this->redirect(return_url());
			}
		}
		exit; 
	}
	 

 
}
