<?php namespace app\modules\oauth\controllers; 
use app\modules\oauth\libraries\oauth2\OAuth2;
use app\modules\oauth\libraries\oauth2\Token;
/**
 *  
 * @author Sun < taichiquan@outlook.com >
 * @Coprighty  http://mincms.com
 */
class GithubController extends OauthController
{
	public $url;
	public $app_key;
	public $app_secret;
	public $oauth_id; 
	public $auth;
	public $type = 'github';
 
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
	 	$code_url = " https://github.com/login/oauth/authorize?client_id=".$this->app_key."&redirect_uri=".urlencode($this->url)."&scope=user,repo,gist"; 
 		header("location:$code_url"); 
 		exit;
	}
	function actionReturn($code){ 
		$url = "https://github.com/login/oauth/access_token?client_id=".$this->app_key."&redirect_uri=".urlencode($this->url)."&client_secret=".$this->app_secret."&code=".$_GET['code'].""; 
		$content = file_get_contents($url);
	
		$s = $content;
	 	$s = explode('&',$s);
		$d = explode('=',$s[0]);
		$access_token = $d[1]; 	 
		if ($access_token){
			try
	        {    	
	        	$this->auth =  OAuth2::provider($this->type, array(
			    	'id' =>$this->app_key, 
	       			'secret' => $this->app_secret, 
			    ));  
			    $token = Token::factory('access', array('access_token'=>$access_token)); 
			    
	            $info = $this->auth->get_user_info($token); 	          
 				$uid = $info['uid']; 
 				$me['id'] = $uid;
 				$me['name'] = $info['name']; 
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
