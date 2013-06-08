<?php namespace app\modules\oauth\controllers; 
use app\modules\oauth\libraries\oauth2\OAuth2;
use app\modules\oauth\libraries\oauth2\Token;
use app\modules\oauth\libraries\oauth2\Provider\Renren;
/**
 * ## 人人
 * @author Sun < mincms@outlook.com >
 * @Coprighty  http://mincms.com
 */
class RenrenController extends OauthController
{
 
	public $type = 'renren';
 
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
	 	$url = Renren::url_authorize()."?client_id=".$this->app_key."&redirect_uri=".urlencode($this->url)."&response_type=code&scope=read_user_album+read_user_feed"; 
 		header("location:$url"); 
 		exit;
	}
	function actionReturn(){ 
		$code = $_GET['code'];
		$url = Renren::url_access_token()."?grant_type=authorization_code&client_id=".$this->app_key."&redirect_uri=".urlencode($this->url)."&client_secret=".$this->app_secret."&code=".$_GET['code'].""; 
 		$data = json_decode(file_get_contents($url)); 
	 	$access_token = $data->access_token; 
	 	$user = $data->user; 
	  
		if ($access_token){
			try
	        {    	
	         
 				$me['id'] = $user->id;
 				$me['name'] = $user->name;  
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
