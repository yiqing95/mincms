<?php namespace app\modules\oauth\controllers; 
use app\modules\oauth\libraries\oauth2\OAuth2;
use app\modules\oauth\libraries\oauth2\Token;
/**
 * ## MSN
 * @author Sun < mincms@outlook.com >
 * @Coprighty  http://mincms.com
 */
class MsnController extends OauthController
{
 
	public $type = 'msn';
 
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
        define('BASEPATH',true);   
		
		
	}
 	public function actionIndex()
	{
	 	$code_url = "https://login.live.com/oauth20_authorize.srf?client_id=".$this->app_key."&scope=wl.basic,wl.signin,wl.emails&response_type=code&redirect_uri=".urlencode($this->url);
  		header("location:$code_url"); 
 		exit;
	}
	function actionReturn(){
		$this->auth = OAuth2::provider('windowslive', array(
	    	'id' =>$this->app_key, 
	        'secret' => $this->app_secret, 
		));     
		$params['redirect_uri'] = $this->url;
		$params['grant_type'] = 'authorization_code';
		$o = $this->auth->access($_GET['code'],$params);
		$_GET['access_token'] = $o->access_token;
	 	$this->save_login(); 
	}
	
	protected function save_login(){
		$access_token = $_GET['access_token'];
		if ($_GET['access_token']){
			try
	        {    
	        	$this->auth =  OAuth2::provider('windowslive', array(
			    	'id' =>$this->app_key, 
	       			'secret' => $this->app_secret, 
			    )); 	          
	            $token = Token::factory('access', array('access_token'=>$access_token)); 
	            $info = $this->auth->get_user_info($token);      
 				$uid = $info['uid']; 
 				$me['id'] = $uid;
 				$me['name'] = $info['name']; 
 				$me['email']  = $info['email']; 
 				$me['nickname'] = $info['nickname']; 
 			 	$me['options']  = $info['urls']; 
			 
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
