<?php
/**
 * MinCMS - An  content manage base on 
 * @author   MinCMS Team <admin@mincms.com | qq¹Ù·½Èº: 40933125>
 * @Coprighty  http://mincms.com
 */
class TwitterController extends Controller
{
	public $url;
	public $app_key;
	public $app_secret;
	public $oauth_id; 
	public $auth;
	public $type = 'twitter';
 
 	/**
 	* load some required files
 	*/
	function init(){
		parent::init(); 
	 	$row = member_get_oauth_type($this->type);
		if(!$row->id){
			exit('access deny');
		} 
		$this->oauth_id = $row->id; 
		$this->app_key = $row->app_key;
		$this->app_secret = $row->app_secret;
		$this->url = host().url('member/'.$this->type.'/return');  
        define('BASEPATH',true); 
        Yii::import('module.member.components.twitter-async.EpiCurl',true);
        Yii::import('module.member.components.twitter-async.EpiOAuth',true); 
        Yii::import('module.member.components.twitter-async.EpiTwitter',true);
        $this->auth = new EpiTwitter($this->app_key, $this->app_secret);  
		
		
	}
 	public function actionIndex()
	{
		$auth = new EpiTwitter($this->app_key, $this->app_secret);  
		$code_url = $this->auth->getAuthorizeUrl(null,array('oauth_callback' => $this->url)); 
		header("location:$code_url"); 
	}
	
 
	function actionReturn(){
		if (!$_GET['oauth_token']) return false;
		$this->auth->setToken($_GET['oauth_token']);  
		$token = $this->auth->getAccessToken(array('oauth_verifier' => $_GET['oauth_verifier']));
		$this->auth->setToken($token->oauth_token, $token->oauth_token_secret);
		$response = $this->auth->get('/account/verify_credentials.json');
		$info = $response->response;
		if($response->code !=200){
			flash('error',__('comm.response error'));
			$this->redirect(url('site/index'));
		} 
		$access_token = serialize(array($token->oauth_token,$token->oauth_token_secret));
		if ($access_token){
			try
	        {    
	           
 				$uid = $info['id']; 
 				$me['id'] = $uid;
 				$me['name'] = $info['name']; 
 				$me['email']  = $info['email']; 
 				$me['nickname'] = $info['screen_name']; 
 				$me['options'] = array('time_zone'=>$info['time_zone']); 
 		 	 
				$r = member_get_third_set_user($me,$this->oauth_id,$access_token);   
				
		 	 	flash('success',__('login success'));
				$this->redirect(return_url());
				
			} catch (OAuthException $e) {
				flash('error',__('login error'));
				$this->redirect(return_url());
			}
		}
	}
	
 

 
}
